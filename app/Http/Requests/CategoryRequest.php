<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Utility\CategoryUtility;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('category');
        return [
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:categories,slug,' . $id,
            'order_level' => 'nullable|integer',
            'digital' => 'required|in:0,1',
            'banner' => 'nullable|integer',
            'icon' => 'nullable|integer',
            'cover_image' => 'nullable|integer',
            'meta_title' => 'nullable|max:255',
            'parent_id' => 'nullable|integer',
            'commision_rate' => 'nullable',
            'filtering_attributes' => 'nullable|array',
            'filtering_attributes.*' => 'exists:attributes,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $parentId = (int) $this->input('parent_id', 0);

            if ($parentId <= 0) {
                return;
            }

            if (!Category::whereKey($parentId)->exists()) {
                $validator->errors()->add('parent_id', translate('The selected parent category is invalid.'));
                return;
            }

            $currentCategoryId = $this->route('category');
            $currentCategoryId = is_object($currentCategoryId) ? $currentCategoryId->id : (int) $currentCategoryId;

            if ($currentCategoryId > 0) {
                if ($parentId === $currentCategoryId) {
                    $validator->errors()->add('parent_id', translate('A category cannot be its own parent.'));
                    return;
                }

                $childrenIds = CategoryUtility::children_ids($currentCategoryId, true);
                if (in_array($parentId, $childrenIds, true)) {
                    $validator->errors()->add('parent_id', translate('A category cannot be moved under one of its own descendants.'));
                }
            }
        });
    }

    public function messages()
    {
        return [
            'name.required' => translate('The category name is required.'),
            'slug.required' => translate('The slug is required.'),
            'slug.unique' => translate('The slug has already been taken.'),
            'digital.required' => translate('Please select the category type.'),
            'banner.image' => translate('The banner must be an image.'),
            'icon.image' => translate('The icon must be an image.'),
            'cover_image.image' => translate('The cover image must be an image.'),
            'parent_id.exists' => translate('The selected parent category is invalid.'),
            'parent_id.integer' => translate('The selected parent category is invalid.'),
            'parent_id.self_parent' => translate('A category cannot be its own parent.'),
            'parent_id.descendant' => translate('A category cannot be moved under one of its own descendants.'),
        ];
    }
}
