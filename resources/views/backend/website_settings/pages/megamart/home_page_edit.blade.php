@extends('backend.layouts.app')

@section('content')
	<div class="page-content">
		<div class="aiz-titlebar text-left mt-2 pb-2 px-3 px-md-2rem border-bottom border-gray">
			<div class="row align-items-center">
				<div class="col">
					<h1 class="h3">{{ translate('Homepage Settings (Megamart)') }}</h1>
				</div>
				{{-- <div class="col text-right">
					<a class="btn has-transition btn-xs p-0 hov-svg-danger" href="{{ route('home') }}"
						target="_blank" data-toggle="tooltip" data-placement="top" data-title="{{ translate('View Tutorial Video') }}">
						<svg xmlns="http://www.w3.org/2000/svg" width="19.887" height="16" viewBox="0 0 19.887 16">
							<path id="_42fbab5a39cb8436403668a76e5a774b" data-name="42fbab5a39cb8436403668a76e5a774b" d="M18.723,8H5.5A3.333,3.333,0,0,0,2.17,11.333v9.333A3.333,3.333,0,0,0,5.5,24h13.22a3.333,3.333,0,0,0,3.333-3.333V11.333A3.333,3.333,0,0,0,18.723,8Zm-3.04,8.88-5.47,2.933a1,1,0,0,1-1.473-.88V13.067a1,1,0,0,1,1.473-.88l5.47,2.933a1,1,0,0,1,0,1.76Zm-5.61-3.257L14.5,16l-4.43,2.377Z" transform="translate(-2.17 -8)" fill="#9da3ae"/>
						</svg>
					</a>
				</div> --}}
			</div>
		</div>

		<div class="d-sm-flex">
			<!-- page side nav -->
			<div class="page-side-nav c-scrollbar-light px-3 py-2">
				<ul class="nav nav-tabs flex-sm-column border-0" role="tablist" aria-orientation="vertical">
					<!-- Home Slider -->
					<li class="nav-item">
						<a class="nav-link" id="home-slider-tab" href="#home_slider"
							data-toggle="tab" data-target="#home_slider" type="button" role="tab" aria-controls="home_slider" aria-selected="true">
							{{ translate('Home Slider') }}
						</a>
					</li>
					<!-- Home CTA -->
					<li class="nav-item">
						<a class="nav-link" id="home-cta-tab" href="#home_cta"
							data-toggle="tab" data-target="#home_cta" type="button" role="tab" aria-controls="home_cta" aria-selected="false">
							{{ translate('Home CTA') }}
						</a>
					</li>
					<!-- Flash Deals -->
					<li class="nav-item">
						<a class="nav-link" id="flash-deals-tab" href="#flash_deals"
							data-toggle="tab" data-target="#flash_deals" type="button" role="tab" aria-controls="flash_deals" aria-selected="false">
							{{ translate('Flash Deals') }}
						</a>
					</li>
					<!-- Today's Deal -->
					<li class="nav-item">
						<a class="nav-link" id="todays-deal-tab" href="#todays_deal"
							data-toggle="tab" data-target="#todays_deal" type="button" role="tab" aria-controls="todays_deal" aria-selected="false">
							{{ translate("Today's Deal") }}
						</a>
					</li>
					<!-- Banner Level 1 -->
					<li class="nav-item">
						<a class="nav-link" id="banner-1-tab" href="#banner_1"
							data-toggle="tab" data-target="#banner_1" type="button" role="tab" aria-controls="banner_1" aria-selected="false">
							{{ translate('Banner Level 1') }}
						</a>
					</li>

					@if(addon_is_activated('preorder'))
					<!-- Preorder  banner 1-->
					<li class="nav-item">
						<a class="nav-link" id="preorder-banner-2-tab" href="#preorder_banner_1"
							data-toggle="tab" data-target="#preorder_banner_1" type="button" role="tab" aria-controls="preorder_banner_1" aria-selected="false">
							{{ translate('Preorder Banner 1') }}
						</a>
					</li>
					@endif
					
					<!-- Banner Level 2 -->
					<li class="nav-item">
						<a class="nav-link" id="banner-2-tab" href="#banner_2"
							data-toggle="tab" data-target="#banner_2" type="button" role="tab" aria-controls="banner_2" aria-selected="false">
							{{ translate('Banner Level 2') }}
						</a>
					</li>
					<!-- Banner Level 3 -->
					<li class="nav-item">
						<a class="nav-link" id="banner-3-tab" href="#banner_3"
							data-toggle="tab" data-target="#banner_3" type="button" role="tab" aria-controls="banner_3" aria-selected="false">
							{{ translate('Banner Level 3') }}
						</a>
					</li>
					<!-- Banner Level 4 -->
					<li class="nav-item">
						<a class="nav-link" id="banner-4-tab" href="#banner_4"
							data-toggle="tab" data-target="#banner_4" type="button" role="tab" aria-controls="banner_4" aria-selected="false">
							{{ translate('Banner Level 4') }}
						</a>
					</li>
					<!-- Top Brands -->
					<li class="nav-item">
						<a class="nav-link" id="brands-tab" href="#brands"
							data-toggle="tab" data-target="#brands" type="button" role="tab" aria-controls="brands" aria-selected="false">
							{{ translate('Top Brands') }}
						</a>
					</li>
					<!-- Banner Level 5 -->
					<li class="nav-item">
						<a class="nav-link" id="banner-5-tab" href="#banner_5"
							data-toggle="tab" data-target="#banner_5" type="button" role="tab" aria-controls="banner_5" aria-selected="false">
							{{ translate('Banner Level 5') }}
						</a>
					</li>
					<!-- Banner Level 6 -->
					<li class="nav-item">
						<a class="nav-link" id="banner-6-tab" href="#banner_6"
							data-toggle="tab" data-target="#banner_6" type="button" role="tab" aria-controls="banner_6" aria-selected="false">
							{{ translate('Banner Level 6') }}
						</a>
					</li>
					@if(addon_is_activated('auction'))
					<!-- Auction Products -->
					<li class="nav-item">
						<a class="nav-link" id="auction-tab" href="#auction"
							data-toggle="tab" data-target="#auction" type="button" role="tab" aria-controls="auction" aria-selected="false">
							{{ translate('Auction Products') }}
							@if (env("DEMO_MODE") == "On")
							<span class="badge badge-pill badge-secondary ml-1">{{ translate('Addon') }}</span>
							@endif
						</a>
					</li>
					@endif
					@if(get_setting('coupon_system') == 1)
					<!-- Coupon Section -->
					<li class="nav-item">
						<a class="nav-link" id="coupon-tab" href="#coupon"
							data-toggle="tab" data-target="#coupon" type="button" role="tab" aria-controls="coupon" aria-selected="false">
							{{ translate('Coupon Section') }}
						</a>
					</li>
					@endif
					<!-- Classifieds -->
					<li class="nav-item">
						<a class="nav-link" id="classifiedss-tab" href="#classifieds"
							data-toggle="tab" data-target="#classifieds" type="button" role="tab" aria-controls="classifieds" aria-selected="false">
							{{ translate('Classifieds') }}
						</a>
					</li>
					
					@if(addon_is_activated('preorder'))
					<!-- Newest Preorder Products -->
					<li class="nav-item">
						<a class="nav-link" id="classifiedss-tab" href="#newestPreorder"
							data-toggle="tab" data-target="#newestPreorder" type="button" role="tab" aria-controls="newestPreorder" aria-selected="false">
							{{ translate('Newest Preorder Products') }}
						</a>
					</li>

					<!-- Preorder Featured Banners -->
					{{-- <li class="nav-item">
						<a class="nav-link" id="featuredPreorder-tab" href="#featuredPreorder"
							data-toggle="tab" data-target="#featuredPreorder" type="button" role="tab" aria-controls="featuredPreorder" aria-selected="false">
							{{ translate('Preorder Featured Banners') }}
						</a>
					</li> --}}
					@endif
					
					<!-- Category Wise Products -->
					<li class="nav-item">
						<a class="nav-link" id="home-categories-tab" href="#home_categories"
							data-toggle="tab" data-target="#home_categories" type="button" role="tab" aria-controls="home_categories" aria-selected="false">
							{{ translate('Category Wise Products') }}
						</a>
					</li>
				</ul>
			</div>

			<!-- tab content -->
			<div class="flex-grow-1 p-sm-3 p-lg-2rem mb-2rem mb-md-0">
				<div class="tab-content">

					<!-- Language Bar -->
					<ul class="nav nav-tabs nav-fill border-light language-bar">
						@foreach (get_all_active_language() as $key => $language)
							<li class="nav-item">
								<a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
									href="{{route('custom-pages.edit', ['id'=>$page->slug, 'lang'=>$language->code, 'page'=>'home'] )}}">
									<img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
										height="11" class="mr-1">
									<span>{{ $language->name }}</span>
								</a>
							</li>
						@endforeach
					</ul>

					<!-- Home Slider -->
					<div class="tab-pane fade" id="home_slider" role="tabpanel" aria-labelledby="home-slider-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="home_slider">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_slider_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_slider_links">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_slider_scales">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="row gutters-16">
									<!-- Slider Section Settings -->
									<div class="col-lg-5 order-lg-1 mb-3">
										<div class="p-4 border h-250px h-lg-300px" style="background: #fcfcfc;">
											<p class="fs-14 fw-500">{{ translate("Slider Section Settings") }}</p>
											<!-- Slider full width checkbox -->
											<div class="form-group ml-4 d-inline-block">
												<label class="aiz-checkbox">
													<input type="hidden" name="types[]" value="slider_section_full_width">
													<input type="checkbox" class="check-one" name="slider_section_full_width" value="1" @if(get_setting('slider_section_full_width') == 1) checked @endif>
													<span class="fs-13 fw-400">{{ translate('Use Slider as full width') }}</span>
													<span class="aiz-square-check"></span>
												</label>
											</div>
											<!-- Select Color -->
											<div class="form-group ml-4">
												<label class="col-from-label">{{ translate('Select background color in this section') }}</label>
												<div class="input-group mb-3">
													<input type="hidden" name="types[]" value="slider_section_bg_color">
													<input type="text" class="form-control aiz-color-input" placeholder="#000000" name="slider_section_bg_color" value="{{ get_setting('slider_section_bg_color') }}">
													<div class="input-group-append">
														<span class="input-group-text p-0">
															<input class="aiz-color-picker border-0 size-40px" type="color" value="{{ get_setting('slider_section_bg_color') }}">
														</span>
													</div>
												</div>
											</div>

											<!-- Top Section Selection (Slider vs CTA) -->
											<div class="form-group ml-4 border-top pt-3 mt-3">
												<label class="fs-14 fw-500">{{ translate('Homepage Top Section Content') }}</label>
												<div>
													<label class="aiz-radio">
														<input type="hidden" name="types[]" value="homepage_top_section">
														<input type="radio" name="homepage_top_section" value="slider" @if(get_setting('homepage_top_section', 'slider') == 'slider') checked @endif>
														<span class="fs-13 fw-400">{{ translate('Show Slider') }}</span>
														<span class="aiz-rounded-check"></span>
													</label>
													<label class="aiz-radio ml-3">
														<input type="radio" name="homepage_top_section" value="cta" @if(get_setting('homepage_top_section') == 'cta') checked @endif>
														<span class="fs-13 fw-400">{{ translate('Show CTA Buttons') }}</span>
														<span class="aiz-rounded-check"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
									<!-- Slider Deal Settings -->
									<div class="col-lg-7">
										<div class="w-100">
											<!-- Information -->
											<div class="fs-11 d-flex mb-2rem">
												<div>
													<svg id="_79508b4b8c932dcad9066e2be4ca34f2" data-name="79508b4b8c932dcad9066e2be4ca34f2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
														<path id="Path_40683" data-name="Path 40683" d="M8,16a8,8,0,1,1,8-8A8.024,8.024,0,0,1,8,16ZM8,1.333A6.667,6.667,0,1,0,14.667,8,6.686,6.686,0,0,0,8,1.333Z" fill="#9da3ae"/>
														<path id="Path_40684" data-name="Path 40684" d="M10.6,15a.926.926,0,0,1-.667-.333c-.333-.467-.067-1.133.667-2.933.133-.267.267-.6.4-.867a.714.714,0,0,1-.933-.067.644.644,0,0,1,0-.933A3.408,3.408,0,0,1,11.929,9a.926.926,0,0,1,.667.333c.333.467.067,1.133-.667,2.933-.133.267-.267.6-.4.867a.714.714,0,0,1,.933.067.644.644,0,0,1,0,.933A3.408,3.408,0,0,1,10.6,15Z" transform="translate(-3.262 -3)" fill="#9da3ae"/>
														<circle id="Ellipse_813" data-name="Ellipse 813" cx="1" cy="1" r="1" transform="translate(8 3.333)" fill="#9da3ae"/>
														<path id="Path_40685" data-name="Path 40685" d="M12.833,7.167a1.333,1.333,0,1,1,1.333-1.333A1.337,1.337,0,0,1,12.833,7.167Zm0-2a.63.63,0,0,0-.667.667.667.667,0,1,0,1.333,0A.63.63,0,0,0,12.833,5.167Z" transform="translate(-3.833 -1.5)" fill="#9da3ae"/>
													</svg>
												</div>
												<div class="ml-2 text-gray">
													<div class="mb-2">{{ translate('Minimum dimensions required: 1903px width X 553px height.') }}</div>
													<div>{{ translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.') }}</div>
												</div>
											</div>

											<!-- Images & links -->
											<div class="home-slider-target">
												@php
													$home_slider_images = get_setting('home_slider_images', null, $lang);
													$home_slider_links = get_setting('home_slider_links', null, $lang);
													$home_slider_scales = get_setting('home_slider_scales', null, $lang);
												@endphp
												@if ($home_slider_images != null)
													@foreach (json_decode($home_slider_images, true) as $key => $value)
														<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
															<div class="row gutters-5">
																<!-- Image -->
																<div class="col-md-4">
																	<div class="form-group mb-md-0">
																		<div class="input-group" data-toggle="aizuploader" data-type="image">
																			<div class="input-group-prepend">
																				<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																			</div>
																			<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																			<input type="hidden" name="home_slider_images[]" class="selected-files" value="{{ json_decode($home_slider_images, true)[$key] }}">
																		</div>
																		<div class="file-preview box sm">
																		</div>
																	</div>
																</div>
																<!-- Inputs -->
																<div class="col-md align-self-center">
																	<!-- link -->
																	<div class="form-group">
																		<label>{{ translate('Link') }}</label>
																		<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]" value="{{ isset(json_decode($home_slider_links, true)[$key]) ? json_decode($home_slider_links, true)[$key] : '' }}">
																	</div>
																	<!-- scale -->
																	<div class="form-group mb-0">
																		<label>{{ translate('Scale') }}</label>
																		<div class="input-group" style="width: 120px;">
																			<input type="number" class="form-control h-slider-scale" placeholder="100" name="home_slider_scales[]" value="{{ isset(json_decode($home_slider_scales, true)[$key]) ? json_decode($home_slider_scales, true)[$key] : '100' }}">
																			<div class="input-group-append">
																				<span class="input-group-text">%</span>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- remove parent button -->
																<div class="col-md-auto align-self-center">
																	<div class="form-group mb-md-0 text-right">
																		<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																			<i class="las la-times"></i>
																		</button>
																	</div>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>

											<!-- Add button -->
											<div class="">
												<button
													type="button"
													class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
													data-toggle="add-more"
													data-content='
													<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
														<div class="row gutters-5">
															<!-- Image -->
															<div class="col-md-4">
																<div class="form-group mb-md-0">
																	<div class="input-group" data-toggle="aizuploader" data-type="image">
																		<div class="input-group-prepend">
																			<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate("Browse")}}</div>
																		</div>
																		<div class="form-control file-amount">{{ translate("Choose File") }}</div>
																		<input type="hidden" name="home_slider_images[]" class="selected-files" value="">
																	</div>
																	<div class="file-preview box sm">
																	</div>
																</div>
															</div>
															<!-- Inputs -->
															<div class="col-md align-self-center">
																<!-- link -->
																<div class="form-group">
																	<label>{{ translate("Link") }}</label>
																	<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]" value="">
																</div>
																<!-- scale -->
																<div class="form-group mb-0">
																	<label>{{ translate("Scale") }}</label>
																	<div class="input-group" style="width: 120px;">
																		<input type="number" class="form-control h-slider-scale" placeholder="100" name="home_slider_scales[]" value="100">
																		<div class="input-group-append">
																			<span class="input-group-text">%</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- remove parent button -->
															<div class="col-md-auto align-self-center">
																<div class="form-group mb-md-0 text-right">
																	<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																		<i class="las la-times"></i>
																	</button>
																</div>
															</div>
														</div>
													</div>
'
													data-target=".home-slider-target">
													<i class="las la-2x text-success la-plus-circle"></i>
													<span class="ml-2">{{ translate('Add New') }}</span>
												</button>
											</div>
										</div>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Home CTA -->
					<div class="tab-pane fade" id="home_cta" role="tabpanel" aria-labelledby="home-cta-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="home_cta">
							
							<div class="bg-white p-3 p-sm-2rem">
								<div class="row">
									<div class="col-lg-8">
										<!-- Logo -->
										<div class="form-group">
											<label class="fs-13 fw-500">{{ translate('CTA Logo') }}</label>
											<div class="input-group" data-toggle="aizuploader" data-type="image">
												<div class="input-group-prepend">
													<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
												</div>
												<div class="form-control file-amount">{{ translate('Choose File') }}</div>
												<input type="hidden" name="types[]" value="home_cta_logo">
												<input type="hidden" name="home_cta_logo" class="selected-files" value="{{ get_setting('home_cta_logo') }}">
											</div>
											<div class="file-preview box sm"></div>
										</div>

										<!-- Title -->
										<div class="form-group">
											<label class="fs-13 fw-500">{{ translate('Main Title') }}</label>
											<input type="hidden" name="types[][{{ $lang }}]" value="home_cta_title">
											<input type="text" class="form-control" name="home_cta_title" value="{{ get_setting('home_cta_title', 'Safe Global Trade - Wholesale and Retail Trade', $lang) }}">
										</div>

										<!-- Descriptions -->
										<div class="form-group">
											<label class="fs-13 fw-500">{{ translate('Description Line 1') }}</label>
											<input type="hidden" name="types[][{{ $lang }}]" value="home_cta_desc1">
											<input type="text" class="form-control" name="home_cta_desc1" value="{{ get_setting('home_cta_desc1', 'Secure wholesale supplies for businesses', $lang) }}">
										</div>
										<div class="form-group">
											<label class="fs-13 fw-500">{{ translate('Description Line 2') }}</label>
											<input type="hidden" name="types[][{{ $lang }}]" value="home_cta_desc2">
											<input type="text" class="form-control" name="home_cta_desc2" value="{{ get_setting('home_cta_desc2', 'Products for individual customers', $lang) }}">
										</div>

										<!-- Button Appearance -->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>{{ translate('Button Shape') }}</label>
													<input type="hidden" name="types[]" value="home_cta_btn_shape">
													<select class="form-control aiz-selectpicker" name="home_cta_btn_shape">
														<option value="square" @if(get_setting('home_cta_btn_shape') == 'square') selected @endif>{{ translate('Square') }}</option>
														<option value="rounded" @if(get_setting('home_cta_btn_shape', 'rounded') == 'rounded') selected @endif>{{ translate('Rounded') }}</option>
														<option value="pill" @if(get_setting('home_cta_btn_shape') == 'pill') selected @endif>{{ translate('Pill') }}</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>{{ translate('Button Size') }}</label>
													<input type="hidden" name="types[]" value="home_cta_btn_size">
													<select class="form-control aiz-selectpicker" name="home_cta_btn_size">
														<option value="small" @if(get_setting('home_cta_btn_size') == 'small') selected @endif>{{ translate('Small') }}</option>
														<option value="medium" @if(get_setting('home_cta_btn_size', 'medium') == 'medium') selected @endif>{{ translate('Medium') }}</option>
														<option value="large" @if(get_setting('home_cta_btn_size') == 'large') selected @endif>{{ translate('Large') }}</option>
													</select>
												</div>
											</div>
										</div>

										<hr>

										<!-- Buttons -->
										<div class="row">
											<div class="col-md-12 mb-3">
												<div class="p-3 border rounded bg-light">
													<div class="row align-items-center">
														<div class="col-md-2">
															<p class="fw-700 text-primary mb-0">{{ translate('Retail Button') }}</p>
														</div>
														<div class="col-md-5">
															<div class="form-group mb-0">
																<label class="mb-0 small text-muted">{{ translate('Label') }}</label>
																<input type="hidden" name="types[][{{ $lang }}]" value="home_cta_btn_retail_label">
																<input type="text" class="form-control" name="home_cta_btn_retail_label" value="{{ get_setting('home_cta_btn_retail_label', 'Retail products', $lang) }}">
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group mb-0">
																<label class="mb-0 small text-muted">{{ translate('Link') }}</label>
																<input type="hidden" name="types[]" value="home_cta_btn_retail_link">
																<input type="text" class="form-control" name="home_cta_btn_retail_link" value="{{ get_setting('home_cta_btn_retail_link', route('search')) }}">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12 mb-3">
												<div class="p-3 border rounded bg-light">
													<div class="row align-items-center">
														<div class="col-md-2">
															<p class="fw-700 text-info mb-0">{{ translate('Wholesale Button') }}</p>
														</div>
														<div class="col-md-5">
															<div class="form-group mb-0">
																<label class="mb-0 small text-muted">{{ translate('Label') }}</label>
																<input type="hidden" name="types[][{{ $lang }}]" value="home_cta_btn_wholesale_label">
																<input type="text" class="form-control" name="home_cta_btn_wholesale_label" value="{{ get_setting('home_cta_btn_wholesale_label', 'Wholesale goods', $lang) }}">
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group mb-0">
																<label class="mb-0 small text-muted">{{ translate('Link') }}</label>
																<input type="hidden" name="types[]" value="home_cta_btn_wholesale_link">
																<input type="text" class="form-control" name="home_cta_btn_wholesale_link" value="{{ get_setting('home_cta_btn_wholesale_link', route('search').'?type=wholesale') }}">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12 mb-3">
												<div class="p-3 border rounded bg-light">
													<div class="row align-items-center">
														<div class="col-md-2">
															<p class="fw-700 text-success mb-0">{{ translate('Seller Button') }}</p>
														</div>
														<div class="col-md-5">
															<div class="form-group mb-0">
																<label class="mb-0 small text-muted">{{ translate('Label') }}</label>
																<input type="hidden" name="types[][{{ $lang }}]" value="home_cta_btn_seller_label">
																<input type="text" class="form-control" name="home_cta_btn_seller_label" value="{{ get_setting('home_cta_btn_seller_label', 'Become a seller', $lang) }}">
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group mb-0">
																<label class="mb-0 small text-muted">{{ translate('Link') }}</label>
																<input type="hidden" name="types[]" value="home_cta_btn_seller_link">
																<input type="text" class="form-control" name="home_cta_btn_seller_link" value="{{ get_setting('home_cta_btn_seller_link', route('shops.create')) }}">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Flash Deals -->
					<div class="tab-pane fade" id="flash_deals" role="tabpanel" aria-labelledby="flash-deals-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="flash_deals">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="row gutters-16">
									<!-- Flash Deal Settings -->
									<div class="col-lg-6">
										<div class="p-4 border h-250px h-lg-300px" style="background: #fcfcfc;">
											<p class="fs-14 fw-500 mb-3">{{ translate("Flash Deal Section Settings") }}</p>
											<!-- Background color -->
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate('Background color') }}</label>
												<div class="input-group mb-3">
													<input type="hidden" name="types[]" value="flash_deal_bg_color">
													<input type="text" class="form-control aiz-color-input" placeholder="#000000" name="flash_deal_bg_color" value="{{ get_setting('flash_deal_bg_color') }}">
													<div class="input-group-append">
														<span class="input-group-text p-0">
															<input class="aiz-color-picker border-0 size-40px" type="color" value="{{ get_setting('flash_deal_bg_color') }}">
														</span>
													</div>
												</div>
											</div>
											<!-- background color checkbox -->
											<div class="form-group d-inline-block">
												<label class="aiz-checkbox">
													<input type="hidden" name="types[]" value="flash_deal_bg_full_width">
													<input type="checkbox" class="check-one" name="flash_deal_bg_full_width" value="1" @if(get_setting('flash_deal_bg_full_width') == 1) checked @endif>
													<span class="fs-13 fw-400">{{ translate('Use background color as full width') }}</span>
													<span class="aiz-square-check"></span>
												</label>
											</div>

											<!-- Banner Text Color -->
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate('Flash Deal Banner Text Color') }}</label>
												<div class="input-group mb-3 d-flex">
													@php
														$flash_deal_banner_text_color = get_setting('flash_deal_banner_menu_text');
													@endphp
													<input type="hidden" name="types[]" value="flash_deal_banner_menu_text">
													<div class="radio mar-btm mr-3 d-flex align-items-center">
														<input id="flash_deal_banner_menu_text_light" class="magic-radio" type="radio" name="flash_deal_banner_menu_text" value="light" @if(( $flash_deal_banner_text_color == 'light') || ($flash_deal_banner_text_color == null)) checked @endif>
														<label for="flash_deal_banner_menu_text_light" class="mb-0 ml-2">{{translate('Light')}}</label>
													</div>
													<div class="radio mar-btm mr-3 d-flex align-items-center">
														<input id="flash_deal_banner_menu_text_dark" class="magic-radio" type="radio" name="flash_deal_banner_menu_text" value="dark" @if($flash_deal_banner_text_color == 'dark') checked @endif>
														<label for="flash_deal_banner_menu_text_dark" class="mb-0 ml-2">{{translate('Dark')}}</label>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Today's Deal -->
					<div class="tab-pane fade" id="todays_deal" role="tabpanel" aria-labelledby="todays-deal-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="todays_deal">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="row gutters-16">
									<!-- Todays Deal Section Settings -->
									<div class="col-lg-5 order-lg-1 mb-3">
										<div class="p-4 border h-250px h-lg-300px" style="background: #fcfcfc;">
											<p class="fs-14 fw-500">{{ translate("Today's Deal Section Settings") }}</p>
											<!-- background color checkbox -->
											<div class="form-group d-inline-block">
												<label class="aiz-checkbox">
													<input type="hidden" name="types[]" value="todays_deal_section_bg">
													<input type="checkbox" class="check-one" name="todays_deal_section_bg" value="1" @if(get_setting('todays_deal_section_bg') == 1) checked @endif>
													<span class="fs-13 fw-400">{{ translate('Use background color in this section') }}</span>
													<span class="aiz-square-check"></span>
												</label>
											</div>
											<!-- Select Color -->
											<div class="form-group ml-4">
												<label class="col-from-label">{{ translate('Select Color') }}</label>
												<div class="input-group mb-3">
													<input type="hidden" name="types[]" value="todays_deal_section_bg_color">
													<input type="text" class="form-control aiz-color-input" placeholder="#000000" name="todays_deal_section_bg_color" value="{{ get_setting('todays_deal_section_bg_color') }}">
													<div class="input-group-append">
														<span class="input-group-text p-0">
															<input class="aiz-color-picker border-0 size-40px" type="color" value="{{ get_setting('todays_deal_section_bg_color') }}">
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Todays Deal Settings -->
									<div class="col-lg-7">
										<div class="w-100">
											<!-- Large Banner -->
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate("Large Banner") }} (<small>{{ translate('Will be shown in large device') }}</small>)</label>
												<div class="input-group " data-toggle="aizuploader" data-type="image">
													<div class="input-group-prepend">
														<div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
													</div>
													<div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[][{{ $lang }}]" value="todays_deal_banner">
													<input type="hidden" name="todays_deal_banner" value="{{ get_setting('todays_deal_banner', null, $lang) }}" class="selected-files">
												</div>
												<div class="file-preview box"></div>
                                                <small class="text-muted">{{ translate("Minimum dimensions required: 1370px width X 242px height.") }}</small>
											</div>

											<!-- Small Banner -->
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate("Small Banner") }} (<small>{{ translate('Will be shown in small device') }}</small>)</label>
												<div class="input-group " data-toggle="aizuploader" data-type="image">
													<div class="input-group-prepend">
														<div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
													</div>
													<div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[][{{ $lang }}]" value="todays_deal_banner_small">
													<input type="hidden" name="todays_deal_banner_small" value="{{ get_setting('todays_deal_banner_small', null, $lang) }}" class="selected-files">
												</div>
												<div class="file-preview box"></div>
                                                <small class="text-muted">{{ translate("Minimum dimensions required: 400px width X 200px height.") }}</small>
											</div>

											<!-- Products background color -->
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate('Products background color') }}</label>
												<div class="input-group">
													@php $todays_deal_bg_color =  get_setting('todays_deal_bg_color') @endphp
													<input type="hidden" name="types[]" value="todays_deal_bg_color">
													<input type="text" class="form-control aiz-color-input" placeholder="#000000" name="todays_deal_bg_color" value="{{ $todays_deal_bg_color }}">
													<div class="input-group-append">
														<span class="input-group-text p-0">
															<input class="aiz-color-picker border-0 size-40px" type="color" value="{{ $todays_deal_bg_color }}">
														</span>
													</div>
												</div>
											</div>

											<!-- Banner Text Color -->
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate("Today's Deal Banner Text Color") }}</label>
												<div class="input-group mb-3 d-flex">
													@php
														$todays_deal_banner_text_color =  get_setting('todays_deal_banner_text_color');
													@endphp
													<input type="hidden" name="types[]" value="todays_deal_banner_text_color">
													<div class="radio mar-btm mr-3 d-flex align-items-center">
														<input id="todays_deal_banner_text_light" class="magic-radio" type="radio" name="todays_deal_banner_text_color" value="light" @if(($todays_deal_banner_text_color == 'light') || ($todays_deal_banner_text_color == null)) checked @endif>
														<label for="todays_deal_banner_text_light" class="mb-0 ml-2">{{translate('Light')}}</label>
													</div>
													<div class="radio mar-btm mr-3 d-flex align-items-center">
														<input id="todays_deal_banner_text_dark" class="magic-radio" type="radio" name="todays_deal_banner_text_color" value="dark" @if($todays_deal_banner_text_color == 'dark') checked @endif>
														<label for="todays_deal_banner_text_dark" class="mb-0 ml-2">{{translate('Dark')}}</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>


					<!-- Banner Level 1 -->
					<div class="tab-pane fade" id="banner_1" role="tabpanel" aria-labelledby="banner-1-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="banner_1">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner1_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner1_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
                                    <div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 315px width X 370px height.") }}</div>

									<!-- Images & links -->
									<div class="home-banner1-target">
										@php
											$home_banner1_images = get_setting('home_banner1_images', null, $lang);
											$home_banner1_links = get_setting('home_banner1_links', null, $lang);
										@endphp
										@if ($home_banner1_images != null)
											@foreach (json_decode($home_banner1_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="home_banner1_images[]" class="selected-files" value="{{ json_decode($home_banner1_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]" value="{{ isset(json_decode($home_banner1_links, true)[$key]) ? json_decode($home_banner1_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="home_banner1_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-banner1-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Preorder Banner 1 -->
					<div class="tab-pane fade" id="preorder_banner_1" role="tabpanel" aria-labelledby="preorder-banner-2-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="preorder_banner_1">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_preorder_banner_1_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_preorder_banner_1_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
									<div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 1370px width X 360px height (If use a single banner).") }}</div>

									<!-- Images & links -->
									<div class="home-preorder_banner_1-target">
										@php
											$home_preorder_banner_1_images = get_setting('home_preorder_banner_1_images', null, $lang);
											$home_preorder_banner_1_links = get_setting('home_preorder_banner_1_links', null, $lang);
										@endphp
										@if ($home_preorder_banner_1_images != null)
											@foreach (json_decode($home_preorder_banner_1_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="home_preorder_banner_1_images[]" class="selected-files" value="{{ json_decode($home_preorder_banner_1_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="home_preorder_banner_1_links[]" value="{{ isset(json_decode($home_preorder_banner_1_links, true)[$key]) ? json_decode($home_preorder_banner_1_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="home_preorder_banner_1_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="home_preorder_banner_1_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-preorder_banner_1-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Banner Level 2 -->
					<div class="tab-pane fade" id="banner_2" role="tabpanel" aria-labelledby="banner-2-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="banner_2">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner2_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner2_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
                                    <div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 1370px width X 450px height (If use a single banner).") }}</div>

									<!-- Images & links -->
									<div class="home-banner2-target">
										@php
											$home_banner2_images = get_setting('home_banner2_images', null, $lang);
											$home_banner2_links = get_setting('home_banner2_links', null, $lang);
										@endphp
										@if ($home_banner2_images != null)
											@foreach (json_decode($home_banner2_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="home_banner2_images[]" class="selected-files" value="{{ json_decode($home_banner2_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]" value="{{ isset(json_decode($home_banner2_links, true)[$key]) ? json_decode($home_banner2_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="home_banner2_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-banner2-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Banner Level 3 -->
					<div class="tab-pane fade" id="banner_3" role="tabpanel" aria-labelledby="banner-3-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="banner_3">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner3_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner3_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
                                    <div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 432px width X 655px height.") }}</div>

									<!-- Images & links -->
									<div class="home-banner3-target">
										@php
											$home_banner3_images = get_setting('home_banner3_images', null, $lang);
											$home_banner3_links = get_setting('home_banner3_links', null, $lang);
										@endphp
										@if ($home_banner3_images != null)
											@foreach (json_decode($home_banner3_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="home_banner3_images[]" class="selected-files" value="{{ json_decode($home_banner3_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="home_banner3_links[]" value="{{ isset(json_decode($home_banner3_links, true)[$key]) ? json_decode($home_banner3_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="home_banner3_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="home_banner3_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-banner3-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Banner Level 4 -->
					<div class="tab-pane fade" id="banner_4" role="tabpanel" aria-labelledby="banner-4-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="banner_4">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner4_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner4_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
                                    <div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 896px width X 655px height.") }}</div>

									<!-- Images & links -->
									<div class="home-banner4-target">
										@php
											$home_banner4_images = get_setting('home_banner4_images', null, $lang);
											$home_banner4_links = get_setting('home_banner4_links', null, $lang);
										@endphp
										@if ($home_banner4_images != null)
											@foreach (json_decode($home_banner4_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="home_banner4_images[]" class="selected-files" value="{{ json_decode($home_banner4_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="home_banner4_links[]" value="{{ isset(json_decode($home_banner4_links, true)[$key]) ? json_decode($home_banner4_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="home_banner4_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="home_banner4_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-banner4-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Top Brands -->
					<div class="tab-pane fade" id="brands" role="tabpanel" aria-labelledby="brands-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="brands">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-3">{{ translate('Top Brands (Max 12)') }}</label>
									<!-- Brands -->
									<div class="form-group">
										<input type="hidden" name="types[]" value="top_brands">
										<select name="top_brands[]" class="form-control aiz-selectpicker" multiple data-max-options="12" data-live-search="true" data-selected="{{ get_setting('top_brands') }}">
											@foreach (\App\Models\Brand::all() as $key => $brand)
												<option value="{{ $brand->id }}">{{ $brand->getTranslation('name') }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Banner Level 5 -->
					<div class="tab-pane fade" id="banner_5" role="tabpanel" aria-labelledby="banner-5-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="banner_5">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner5_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner5_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
                                    <div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 432px width X 655px height.") }}</div>

									<!-- Images & links -->
									<div class="home-banner5-target">
										@php
											$home_banner5_images = get_setting('home_banner5_images', null, $lang);
											$home_banner5_links = get_setting('home_banner5_links', null, $lang);
										@endphp
										@if ($home_banner5_images != null)
											@foreach (json_decode($home_banner5_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="home_banner5_images[]" class="selected-files" value="{{ json_decode($home_banner5_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="home_banner5_links[]" value="{{ isset(json_decode($home_banner5_links, true)[$key]) ? json_decode($home_banner5_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="home_banner5_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="home_banner5_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-banner5-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Banner Level 6 -->
					<div class="tab-pane fade" id="banner_6" role="tabpanel" aria-labelledby="banner-6-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="banner_6">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner6_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="home_banner6_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
                                    <div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 432px width X 655px height.") }}</div>

									<!-- Images & links -->
									<div class="home-banner6-target">
										@php
											$home_banner6_images = get_setting('home_banner6_images', null, $lang);
											$home_banner6_links = get_setting('home_banner6_links', null, $lang);
										@endphp
										@if ($home_banner6_images != null)
											@foreach (json_decode($home_banner6_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="home_banner6_images[]" class="selected-files" value="{{ json_decode($home_banner6_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="home_banner6_links[]" value="{{ isset(json_decode($home_banner6_links, true)[$key]) ? json_decode($home_banner6_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="home_banner6_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="home_banner6_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-banner6-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					@if(addon_is_activated('auction'))
					<!-- Auction Banner -->
					<div class="tab-pane fade" id="auction" role="tabpanel" aria-labelledby="auction-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="auction">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-3">{{ translate('Auction Banner') }}</label>
									<!-- Images -->
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[][{{ $lang }}]" value="auction_banner_image">
											<input type="hidden" name="auction_banner_image" class="selected-files" value="{{ get_setting('auction_banner_image', null, $lang) }}">
										</div>
										<div class="file-preview box sm">
										</div>
                                        <small class="text-muted">{{ translate("Minimum dimensions required: 435px width X 485px height.") }}</small>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>
					@endif

					@if(get_setting('coupon_system') == 1)
					<!-- Coupon system -->
					<div class="tab-pane fade" id="coupon" role="tabpanel" aria-labelledby="coupon-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="coupon">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<div class="row gutters-16">
										<!-- Background Color -->
										<div class="col-lg-12">
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate('Background color') }}</label>
												<div class="input-group mb-3">
													@php $coupon_background_color = get_setting('cupon_background_color') @endphp
													<input type="hidden" name="types[]" value="cupon_background_color">
													<input type="text" class="form-control aiz-color-input" placeholder="#000000" name="cupon_background_color" value="{{ $coupon_background_color }}">
													<div class="input-group-append">
														<span class="input-group-text p-0">
															<input class="aiz-color-picker border-0 size-40px" type="color" value="{{ $coupon_background_color }}">
														</span>
													</div>
												</div>
											</div>
										</div>
										<!-- Title -->
										<div class="col-lg-12">
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate('Title') }}</label>
												<input type="hidden" name="types[][{{ $lang }}]" value="cupon_title">
												<input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="cupon_title" value="{{ get_setting('cupon_title', null, $lang) }}">
											</div>
										</div>
										<!-- Subtitle -->
										<div class="col-12">
											<div class="form-group">
												<label class="col-from-label fs-13 fw-500">{{ translate('Subtitle') }}</label>
												<input type="hidden" name="types[][{{ $lang }}]" value="cupon_subtitle">
												<input type="text" class="form-control" placeholder="{{ translate('Subtitle') }}" name="cupon_subtitle" value="{{ get_setting('cupon_subtitle', null, $lang) }}">
											</div>
										</div>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>
					@endif

					<!-- Classifieds -->
					<div class="tab-pane fade" id="classifieds" role="tabpanel" aria-labelledby="classifieds-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="classifieds">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="form-group">
									<label class="col-from-label fs-13 fw-500">{{ translate("Banner") }}</label>
									<div class="input-group " data-toggle="aizuploader" data-type="image">
										<div class="input-group-prepend">
											<div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
										</div>
										<div class="form-control file-amount">{{ translate('Choose File') }}</div>
										<input type="hidden" name="types[][{{ $lang }}]" value="classified_banner_image_small">
										<input type="hidden" name="classified_banner_image_small" value="{{ get_setting('classified_banner_image_small', null, $lang) }}" class="selected-files">
									</div>
									<div class="file-preview box"></div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>
					<!-- newestPreorder -->
					<div class="tab-pane fade" id="newestPreorder" role="tabpanel" aria-labelledby="newestPreorder-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="newestPreorder">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="form-group">
									<label class="col-from-label fs-13 fw-500">{{ translate("Banner") }}</label>
									<div class="input-group " data-toggle="aizuploader" data-type="image">
										<div class="input-group-prepend">
											<div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
										</div>
										<div class="form-control file-amount">{{ translate('Choose File') }}</div>
										<input type="hidden" name="types[][{{ $lang }}]" value="newest_preorder_banner_image">
										<input type="hidden" name="newest_preorder_banner_image" value="{{ get_setting('newest_preorder_banner_image', null, $lang) }}" class="selected-files">
									</div>
									<div class="file-preview box"></div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Featured Preorder -->
					<div class="tab-pane fade" id="featuredPreorder" role="tabpanel" aria-labelledby="banner-1-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="featuredPreorder">
							<input type="hidden" name="types[][{{ $lang }}]" value="featuredPreorder_images">
							<input type="hidden" name="types[][{{ $lang }}]" value="featuredPreorder_links">

							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-0">{{ translate('Banner & Links (Max 3)') }}</label>
                                    <div class="small text-muted mb-3">{{ translate("Minimum dimensions required: 315px width X 370px height.") }}</div>

									<!-- Images & links -->
									<div class="home-banner1-target">
										@php
											$featuredPreorder_images = get_setting('featuredPreorder_images', null, $lang);
											$featuredPreorder_links = get_setting('featuredPreorder_links', null, $lang);
										@endphp
										@if ($featuredPreorder_images != null)
											@foreach (json_decode($featuredPreorder_images, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<!-- Image -->
														<div class="col-md-5">
															<div class="form-group mb-md-0">
																<div class="input-group" data-toggle="aizuploader" data-type="image">
																	<div class="input-group-prepend">
																		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																	</div>
																	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																	<input type="hidden" name="featuredPreorder_images[]" class="selected-files" value="{{ json_decode($featuredPreorder_images, true)[$key] }}">
																</div>
																<div class="file-preview box sm">
																</div>
															</div>
														</div>
														<!-- link -->
														<div class="col-md">
															<div class="form-group mb-md-0">
																<input type="text" class="form-control" placeholder="http://" name="featuredPreorder_links[]" value="{{ isset(json_decode($featuredPreorder_links, true)[$key]) ? json_decode($featuredPreorder_links, true)[$key] : '' }}">
															</div>
														</div>
														<!-- remove parent button -->
														<div class="col-md-auto">
															<div class="form-group mb-md-0">
																<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																	<i class="las la-times"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<!-- Image -->
													<div class="col-md-5">
														<div class="form-group mb-md-0">
															<div class="input-group" data-toggle="aizuploader" data-type="image">
																<div class="input-group-prepend">
																	<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
																</div>
																<div class="form-control file-amount">{{ translate('Choose File') }}</div>
																<input type="hidden" name="featuredPreorder_images[]" class="selected-files" value="">
															</div>
															<div class="file-preview box sm">
															</div>
														</div>
													</div>
													<!-- link -->
													<div class="col-md">
														<div class="form-group mb-md-0 mb-0">
															<input type="text" class="form-control" placeholder="http://" name="featuredPreorder_links[]" value="">
														</div>
													</div>
													<!-- remove parent button -->
													<div class="col-md-auto">
														<div class="form-group mb-md-0">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											</div>'
											data-target=".home-banner1-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Category Wise Products -->
					<div class="tab-pane fade" id="home_categories" role="tabpanel" aria-labelledby="home-categories-tab">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="tab" value="home_categories">
							<div class="bg-white p-3 p-sm-2rem">
								<div class="w-100">
									<label class="col-from-label fs-13 fw-500 mb-3">{{ translate('Categories') }}</label>
									<div class="home-categories-target">
										<input type="hidden" name="types[]" value="home_categories">
										@php $home_categories = get_setting('home_categories'); @endphp
										@if ($home_categories != null)
											@php $categories = \App\Models\Category::where('parent_id', 0)->with('childrenCategories')->get(); @endphp
											@foreach (json_decode($home_categories, true) as $key => $value)
												<div class="p-3 p-md-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
													<div class="row gutters-5">
														<div class="col">
															<div class="form-group mb-0">
																<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" data-selected={{ $value }} required>
																	@foreach ($categories as $category)
																		<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
																		@foreach ($category->childrenCategories as $childCategory)
																			@include('categories.child_category', ['child_category' => $childCategory])
																		@endforeach
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-auto">
															<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
																<i class="las la-times"></i>
															</button>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>

									<!-- Add button -->
									<div class="">
										<button
											type="button"
											class="btn btn-block border hov-bg-soft-secondary fs-14 rounded-0 d-flex align-items-center justify-content-center" style="background: #fcfcfc;"
											data-toggle="add-more"
											data-content='
											<div class="p-4 mb-3 mb-md-2rem remove-parent" style="border: 1px dashed #e4e5eb;">
												<div class="row gutters-5">
													<div class="col">
														<div class="form-group mb-0">
															<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" required>
																@foreach (\App\Models\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
																	<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
																	@foreach ($category->childrenCategories as $childCategory)
																		@include('categories.child_category', ['child_category' => $childCategory])
																	@endforeach
																@endforeach
															</select>
														</div>
													</div>
													<div class="col-auto">
														<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".remove-parent">
															<i class="las la-times"></i>
														</button>
													</div>
												</div>
											</div>'
											data-target=".home-categories-target">
											<i class="las la-2x text-success la-plus-circle"></i>
											<span class="ml-2">{{ translate('Add New') }}</span>
										</button>
									</div>
								</div>
								<!-- Save Button -->
								<div class="mt-4 text-right">
									<button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Save') }}</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection

@section('script')
    <script type="text/javascript">
		$(document).ready(function(){
		    AIZ.plugins.bootstrapSelect('refresh');
		});
    </script>
	<script>
		$(document).ready(function(){
			var hash = document.location.hash;
			if (hash) {
				$('.nav-tabs a[href="'+hash+'"]').tab('show');
			}else{
				$('.nav-tabs a[href="#home_slider"]').tab('show');
			}

			// Change hash for page-reload
			$('.nav-tabs a').on('shown.bs.tab', function (e) {
				window.location.hash = e.target.hash;
			});
		});

		$(document).on('input', '.h-slider-scale', function() {
			var scale = $(this).val();
			var $preview = $(this).closest('.remove-parent').find('.file-preview');
			if ($preview.length > 0) {
				$preview.find('img').css('transform', 'scale(' + (scale / 100) + ')');
			}
		});

		// Apply initial scaling to existing previews
		$(document).ready(function() {
			$('.h-slider-scale').each(function() {
				var scale = $(this).val();
				var $preview = $(this).closest('.remove-parent').find('.file-preview');
				if ($preview.length > 0) {
					$preview.find('img').css('transform', 'scale(' + (scale / 100) + ')');
				}
			});
		});

		// Ensure images added via aizuploader also get scaled if a scale is already present
		$(document).on('change', '.selected-files', function() {
			var $row = $(this).closest('.remove-parent');
			var scale = $row.find('.h-slider-scale').val();
			// Delay slightly to wait for AIZ uploader to render the image
			setTimeout(function() {
				$row.find('.file-preview img').css('transform', 'scale(' + (scale / 100) + ')');
			}, 300);
		});
	</script>
	<style>
		.file-preview.box {
			overflow: hidden !important;
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
		}
		.file-preview.box img {
			transition: transform 0.2s ease-in-out;
		}
	</style>
@endsection
