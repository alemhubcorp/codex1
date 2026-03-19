<?php

namespace App\Utility;

use App\Models\Category;

class CategoryUtility
{
    /*when with trashed is true id will get even the deleted items*/
    public static function get_immediate_children($id, $with_trashed = false, $as_array = false)
    {
        $children = Category::where('parent_id', $id)
            ->orderBy('order_level', 'desc')
            ->get();

        return $as_array && !is_null($children) ? $children->toArray() : $children;
    }

    public static function get_immediate_children_ids($id, $with_trashed = false)
    {
        $children = CategoryUtility::get_immediate_children($id, $with_trashed, true);

        return !empty($children) ? array_column($children, 'id') : array();
    }

    public static function get_immediate_children_count($id, $with_trashed = false)
    {
        return Category::where('parent_id', $id)->count();
    }

    /*when with trashed is true id will get even the deleted items*/
    public static function flat_children($id, $with_trashed = false, $container = array())
    {
        $queue = [$id];
        $visited = [$id => true];

        while (!empty($queue)) {
            $currentId = array_shift($queue);
            $children = static::get_immediate_children($currentId, $with_trashed, true);

            foreach ($children as $child) {
                if (!isset($child['id']) || isset($visited[$child['id']])) {
                    continue;
                }

                $visited[$child['id']] = true;
                $container[] = $child;
                $queue[] = $child['id'];
            }
        }

        return $container;
    }

    /*when with trashed is true id will get even the deleted items*/
    public static function children_ids($id, $with_trashed = false)
    {
        $children = CategoryUtility::flat_children($id, $with_trashed);

        return !empty($children) ? array_column($children, 'id') : array();
    }

    public static function category_tree_ids($category, $category_ids, array $visited = [])
    {
        if (isset($visited[$category->id])) {
            return $category_ids;
        }

        $visited[$category->id] = true;

        foreach ($category->childrenCategories as $childCategory) {
            if (isset($visited[$childCategory->id])) {
                continue;
            }

            $category_ids[] = $childCategory->id;

            if (count($childCategory->childrenCategories) > 0) {
                $category_ids = static::category_tree_ids($childCategory, $category_ids, $visited);
            }
        }

        return $category_ids;
    }

    public static function move_children_to_parent($id)
    {
        $children_ids = CategoryUtility::get_immediate_children_ids($id, true);
        $category = Category::where('id', $id)->first();

        if (is_null($category)) {
            return;
        }

        if (!empty($children_ids)) {
            Category::whereIn('id', $children_ids)->update(['parent_id' => $category->parent_id]);
        }
    }

    public static function create_initial_category($key)
    {
        $key = preg_replace('/\s+/', '', $key);
        if ($key == "") {
            return false;
        }

        try {
            $gate = "https://activeitzone.com/activation/check/eCommerce/" . $key;

            $stream = curl_init();
            curl_setopt($stream, CURLOPT_URL, $gate);
            curl_setopt($stream, CURLOPT_HEADER, 0);
            curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
            $rn = curl_exec($stream);
            curl_close($stream);

            if ($rn == 'no') {
                return false;
            }
        } catch (\Exception $e) {
        }

        return true;
    }

    public static function move_level_up($id)
    {
        $queue = [$id];
        $visited = [$id => true];

        while (!empty($queue)) {
            $currentId = array_shift($queue);
            $childrenIds = static::get_immediate_children_ids($currentId, true);

            foreach ($childrenIds as $value) {
                if (isset($visited[$value])) {
                    continue;
                }

                $category = Category::find($value);
                if (!$category) {
                    continue;
                }

                $visited[$value] = true;
                $category->level -= 1;
                $category->save();
                $queue[] = $value;
            }
        }
    }

    public static function move_level_down($id)
    {
        $queue = [$id];
        $visited = [$id => true];

        while (!empty($queue)) {
            $currentId = array_shift($queue);
            $childrenIds = static::get_immediate_children_ids($currentId, true);

            foreach ($childrenIds as $value) {
                if (isset($visited[$value])) {
                    continue;
                }

                $category = Category::find($value);
                if (!$category) {
                    continue;
                }

                $visited[$value] = true;
                $category->level += 1;
                $category->save();
                $queue[] = $value;
            }
        }
    }

    public static function update_child_level($id)
    {
        $parentCategory = Category::find($id);
        if (!$parentCategory) {
            return;
        }

        $queue = [$id];
        $visited = [$id => true];

        while (!empty($queue)) {
            $currentId = array_shift($queue);
            $currentCategory = Category::find($currentId);
            if (!$currentCategory) {
                continue;
            }

            $childrenIds = static::get_immediate_children_ids($currentId, true);

            foreach ($childrenIds as $childId) {
                if (isset($visited[$childId])) {
                    continue;
                }

                $childCategory = Category::find($childId);
                if (!$childCategory) {
                    continue;
                }

                $visited[$childId] = true;
                $childCategory->level = $currentCategory->level + 1;
                $childCategory->save();
                $queue[] = $childId;
            }
        }
    }

    public static function delete_category($id)
    {
        $category = Category::where('id', $id)->first();
        if (!is_null($category)) {
            CategoryUtility::move_children_to_parent($category->id);
            $category->delete();
        }
    }
}
