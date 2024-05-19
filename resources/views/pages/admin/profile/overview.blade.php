@extends('layouts.admin.admin')

@section('content')
<div id="kt_app_content_container" class="app-container container-xxl">
  <!--begin::Navbar-->
  <div class="card card-flush mb-9" id="kt_user_profile_panel">
    <!--begin::Hero nav-->
    <div class="card-header rounded-top bgi-size-cover h-200px" style="background-position: 100% 50%; background-image:url('{{ asset('storage/assets/media/misc/profile-head-bg.jpg') }}')"></div>
    <!--end::Hero nav-->
    <!--begin::Body-->
    <div class="card-body mt-n19">
      <!--begin::Details-->
      <div class="m-0">
        <!--begin: Pic-->
        <div class="d-flex flex-stack align-items-end pb-4 mt-n19">
          <div class="symbol symbol-125px symbol-lg-150px symbol-fixed position-relative mt-n3">
            <img src="{{ asset('storage/assets/media/avatars/300-3.jpg') }}" alt="image" class="border border-white border-4" style="border-radius: 20px" />
            <div class="position-absolute translate-middle bottom-0 start-100 ms-n1 mb-9 bg-success rounded-circle h-15px w-15px"></div>
          </div>
          <!--begin::Toolbar-->
          <div class="me-0">
            <button class="btn btn-icon btn-sm btn-active-color-primary justify-content-end pt-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              <i class="fonticon-settings fs-2"></i>
            </button>
            <!--begin::Menu 3-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
              <!--begin::Heading-->
              <div class="menu-item px-3">
                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
              </div>
              <!--end::Heading-->
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">Create Invoice</a>
              </div>
              <!--end::Menu item-->
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <a href="#" class="menu-link flex-stack px-3">Create Payment
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
              </div>
              <!--end::Menu item-->
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">Generate Bill</a>
              </div>
              <!--end::Menu item-->
              <!--begin::Menu item-->
              <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                <a href="#" class="menu-link px-3">
                  <span class="menu-title">Subscription</span>
                  <span class="menu-arrow"></span>
                </a>
                <!--begin::Menu sub-->
                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Plans</a>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Billing</a>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Statements</a>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu separator-->
                  <div class="separator my-2"></div>
                  <!--end::Menu separator-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <div class="menu-content px-3">
                      <!--begin::Switch-->
                      <label class="form-check form-switch form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                        <!--end::Input-->
                        <!--end::Label-->
                        <span class="form-check-label text-muted fs-6">Recuring</span>
                        <!--end::Label-->
                      </label>
                      <!--end::Switch-->
                    </div>
                  </div>
                  <!--end::Menu item-->
                </div>
                <!--end::Menu sub-->
              </div>
              <!--end::Menu item-->
              <!--begin::Menu item-->
              <div class="menu-item px-3 my-1">
                <a href="#" class="menu-link px-3">Settings</a>
              </div>
              <!--end::Menu item-->
            </div>
            <!--end::Menu 3-->
          </div>
          <!--end::Toolbar-->
        </div>
        <!--end::Pic-->
        <!--begin::Info-->
        <div class="d-flex flex-stack flex-wrap align-items-end">
          <!--begin::User-->
          <div class="d-flex flex-column">
            <!--begin::Name-->
            <div class="d-flex align-items-center mb-2">
              <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">{{ session('user')['nomcomplet'] }}</a>
              <a href="#" class="" data-bs-toggle="tooltip" data-bs-placement="right" title="Account is verified">
                <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                <span class="svg-icon svg-icon-1 svg-icon-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                    <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor" />
                    <path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                  </svg>
                </span>
                <!--end::Svg Icon-->
              </a>
            </div>
            <!--end::Name-->
            <!--begin::Text-->
            <span class="fw-bold text-gray-600 fs-6 mb-2 d-block">Design is like a fart. If you have to force it, it’s probably shit.</span>
            <!--end::Text-->
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap fw-semibold fs-7 pe-2">
              <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary">UI/UX Design</a>
              <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
              <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary">Austin, TX</a>
              <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
              <a href="#" class="text-gray-400 text-hover-primary">3,450 Followers</a>
            </div>
            <!--end::Info-->
          </div>
          <!--end::User-->
          <!--begin::Actions-->
          <div class="d-flex">
            <a href="#" class="btn btn-sm btn-light me-3" id="kt_drawer_chat_toggle">Send Message</a>
            <button class="btn btn-sm btn-primary" id="kt_user_follow_button">
              <!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
              <span class="svg-icon svg-icon-3 d-none">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path opacity="0.3" d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="currentColor" />
                  <path d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="currentColor" />
                </svg>
              </span>
              <!--end::Svg Icon-->
              <!--begin::Indicator label-->
              <span class="indicator-label">Follow</span>
              <!--end::Indicator label-->
              <!--begin::Indicator progress-->
              <span class="indicator-progress">Please wait...
              <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
              <!--end::Indicator progress-->
            </button>
          </div>
          <!--end::Actions-->
        </div>
        <!--end::Info-->
      </div>
      <!--end::Details-->
    </div>
  </div>
  <!--end::Navbar-->
  <!--begin::Nav items-->
  <div id="kt_user_profile_nav" class="rounded bg-gray-200 d-flex flex-stack flex-wrap mb-9 p-2" data-kt-sticky="true" data-kt-sticky-name="sticky-profile-navs" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{target: '#kt_user_profile_panel'}" data-kt-sticky-left="auto" data-kt-sticky-top="70px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
    <!--begin::Nav-->
    <ul class="nav flex-wrap border-transparent">
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1 active" href="../../demo1/dist/account/overview.html">Overview</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/settings.html">Settings</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/security.html">Security</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/activity.html">Activity</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/billing.html">Billing</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/statements.html">Statements</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/referrals.html">Referrals</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/api-keys.html">API Keys</a>
      </li>
      <!--end::Nav item-->
      <!--begin::Nav item-->
      <li class="nav-item my-1">
        <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" href="../../demo1/dist/account/logs.html">Logs</a>
      </li>
      <!--end::Nav item-->
    </ul>
    <!--end::Nav-->
  </div>
  <!--end::Nav items-->
  <!--begin::details View-->
  <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
      <!--begin::Card title-->
      <div class="card-title m-0">
        <h3 class="fw-bold m-0">Profile Details</h3>
      </div>
      <!--end::Card title-->
      <!--begin::Action-->
      <a href="../../demo1/dist/account/settings.html" class="btn btn-sm btn-primary align-self-center">Edit Profile</a>
      <!--end::Action-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body p-9">
      <!--begin::Row-->
      <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
          <span class="fw-bold fs-6 text-gray-800">Max Smith</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Row-->
      <!--begin::Input group-->
      <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-semibold text-muted">Company</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-semibold text-gray-800 fs-6">Keenthemes</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->
      <!--begin::Input group-->
      <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-semibold text-muted">Contact Phone
        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i></label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8 d-flex align-items-center">
          <span class="fw-bold fs-6 text-gray-800 me-2">044 3276 454 935</span>
          <span class="badge badge-success">Verified</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->
      <!--begin::Input group-->
      <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-semibold text-muted">Company Site</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
          <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">keenthemes.com</a>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->
      <!--begin::Input group-->
      <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-semibold text-muted">Country
        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
          <span class="fw-bold fs-6 text-gray-800">Germany</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->
      <!--begin::Input group-->
      <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-semibold text-muted">Communication</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
          <span class="fw-bold fs-6 text-gray-800">Email, Phone</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->
      <!--begin::Input group-->
      <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-semibold text-muted">Allow Changes</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
          <span class="fw-semibold fs-6 text-gray-800">Yes</span>
        </div>
        <!--begin::Label-->
      </div>
      <!--end::Input group-->
      <!--begin::Notice-->
      <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
        <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
          </svg>
        </span>
        <!--end::Svg Icon-->
        <!--end::Icon-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-grow-1">
          <!--begin::Content-->
          <div class="fw-semibold">
            <h4 class="text-gray-900 fw-bold">We need your attention!</h4>
            <div class="fs-6 text-gray-700">Your payment was declined. To start using tools, please
            <a class="fw-bold" href="../../demo1/dist/account/billing.html">Add Payment Method</a>.</div>
          </div>
          <!--end::Content-->
        </div>
        <!--end::Wrapper-->
      </div>
      <!--end::Notice-->
    </div>
    <!--end::Card body-->
  </div>
  <!--end::details View-->
  <!--begin::Row-->
  <div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-8 mb-xl-10">
      <!--begin::Chart widget 5-->
      <div class="card card-flush h-lg-100">
        <!--begin::Header-->
        <div class="card-header flex-nowrap pt-5">
          <!--begin::Title-->
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Top Selling Categories</span>
            <span class="text-gray-400 pt-2 fw-semibold fs-6">8k social visitors</span>
          </h3>
          <!--end::Title-->
          <!--begin::Toolbar-->
          <div class="card-toolbar">
            <!--begin::Menu-->
            <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
              <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
              <span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                  <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                  <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                  <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </button>
            <!--begin::Menu 2-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
              </div>
              <!--end::Menu item-->
              <!--begin::Menu separator-->
              <div class="separator mb-3 opacity-75"></div>
              <!--end::Menu separator-->
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">New Ticket</a>
              </div>
              <!--end::Menu item-->
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">New Customer</a>
              </div>
              <!--end::Menu item-->
              <!--begin::Menu item-->
              <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                <!--begin::Menu item-->
                <a href="#" class="menu-link px-3">
                  <span class="menu-title">New Group</span>
                  <span class="menu-arrow"></span>
                </a>
                <!--end::Menu item-->
                <!--begin::Menu sub-->
                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Admin Group</a>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Staff Group</a>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Member Group</a>
                  </div>
                  <!--end::Menu item-->
                </div>
                <!--end::Menu sub-->
              </div>
              <!--end::Menu item-->
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">New Contact</a>
              </div>
              <!--end::Menu item-->
              <!--begin::Menu separator-->
              <div class="separator mt-3 opacity-75"></div>
              <!--end::Menu separator-->
              <!--begin::Menu item-->
              <div class="menu-item px-3">
                <div class="menu-content px-3 py-3">
                  <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                </div>
              </div>
              <!--end::Menu item-->
            </div>
            <!--end::Menu 2-->
            <!--end::Menu-->
          </div>
          <!--end::Toolbar-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-5 ps-6">
          <div id="kt_charts_widget_5" class="min-h-auto"></div>
        </div>
        <!--end::Body-->
      </div>
      <!--end::Chart widget 5-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-4 mb-5 mb-xl-10">
      <!--begin::Engage widget 1-->
      <div class="card h-md-100" dir="ltr">
        <!--begin::Body-->
        <div class="card-body d-flex flex-column flex-center">
          <!--begin::Heading-->
          <div class="mb-2">
            <!--begin::Title-->
            <h1 class="fw-semibold text-gray-800 text-center lh-lg">Have you tried
            <br />new
            <span class="fw-bolder">Mobile Application ?</span></h1>
            <!--end::Title-->
            <!--begin::Illustration-->
            <div class="py-10 text-center">
              <img src="assets/media/svg/illustrations/easy/1.svg" class="theme-light-show w-200px" alt="" />
              <img src="assets/media/svg/illustrations/easy/1-dark.svg" class="theme-dark-show w-200px" alt="" />
            </div>
            <!--end::Illustration-->
          </div>
          <!--end::Heading-->
          <!--begin::Links-->
          <div class="text-center mb-1">
            <!--begin::Link-->
            <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_create_app" data-bs-toggle="modal">Try now</a>
            <!--end::Link-->
            <!--begin::Link-->
            <a class="btn btn-sm btn-light" href="../../demo1/dist/apps/invoices/view/invoice-1.html">Learn more</a>
            <!--end::Link-->
          </div>
          <!--end::Links-->
        </div>
        <!--end::Body-->
      </div>
      <!--end::Engage widget 1-->
    </div>
    <!--end::Col-->
  </div>
  <!--end::Row-->
  <!--begin::Row-->
  <div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4">
      <!--begin::List widget 5-->
      <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
          <!--begin::Title-->
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Product Delivery</span>
            <span class="text-gray-400 mt-1 fw-semibold fs-6">1M Products Shipped so far</span>
          </h3>
          <!--end::Title-->
          <!--begin::Toolbar-->
          <div class="card-toolbar">
            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="btn btn-sm btn-light">Order Details</a>
          </div>
          <!--end::Toolbar-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Scroll-->
          <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
            <!--begin::Item-->
            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
              <!--begin::Info-->
              <div class="d-flex flex-stack mb-3">
                <!--begin::Wrapper-->
                <div class="me-3">
                  <!--begin::Icon-->
                  <img src="assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Elephant 1802</a>
                  <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Action-->
                <div class="m-0">
                  <!--begin::Menu-->
                  <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                    <span class="svg-icon svg-icon-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </button>
                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Ticket</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Customer</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                      <!--begin::Menu item-->
                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                      </a>
                      <!--end::Menu item-->
                      <!--begin::Menu sub-->
                      <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                      </div>
                      <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Contact</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mt-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                      </div>
                    </div>
                    <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->
                  <!--end::Menu-->
                </div>
                <!--end::Action-->
              </div>
              <!--end::Info-->
              <!--begin::Customer-->
              <div class="d-flex flex-stack">
                <!--begin::Name-->
                <span class="text-gray-400 fw-bold">To:
                <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Jason Bourne</a></span>
                <!--end::Name-->
                <!--begin::Label-->
                <span class="badge badge-light-success">Delivered</span>
                <!--end::Label-->
              </div>
              <!--end::Customer-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
              <!--begin::Info-->
              <div class="d-flex flex-stack mb-3">
                <!--begin::Wrapper-->
                <div class="me-3">
                  <!--begin::Icon-->
                  <img src="assets/media/stock/ecommerce/209.gif" class="w-50px ms-n1 me-1" alt="" />
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">RiseUP</a>
                  <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Action-->
                <div class="m-0">
                  <!--begin::Menu-->
                  <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                    <span class="svg-icon svg-icon-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </button>
                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Ticket</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Customer</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                      <!--begin::Menu item-->
                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                      </a>
                      <!--end::Menu item-->
                      <!--begin::Menu sub-->
                      <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                      </div>
                      <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Contact</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mt-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                      </div>
                    </div>
                    <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->
                  <!--end::Menu-->
                </div>
                <!--end::Action-->
              </div>
              <!--end::Info-->
              <!--begin::Customer-->
              <div class="d-flex flex-stack">
                <!--begin::Name-->
                <span class="text-gray-400 fw-bold">To:
                <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Marie Durant</a></span>
                <!--end::Name-->
                <!--begin::Label-->
                <span class="badge badge-light-primary">Shipping</span>
                <!--end::Label-->
              </div>
              <!--end::Customer-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
              <!--begin::Info-->
              <div class="d-flex flex-stack mb-3">
                <!--begin::Wrapper-->
                <div class="me-3">
                  <!--begin::Icon-->
                  <img src="assets/media/stock/ecommerce/214.gif" class="w-50px ms-n1 me-1" alt="" />
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Yellow Stone</a>
                  <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Action-->
                <div class="m-0">
                  <!--begin::Menu-->
                  <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                    <span class="svg-icon svg-icon-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </button>
                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Ticket</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Customer</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                      <!--begin::Menu item-->
                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                      </a>
                      <!--end::Menu item-->
                      <!--begin::Menu sub-->
                      <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                      </div>
                      <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Contact</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mt-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                      </div>
                    </div>
                    <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->
                  <!--end::Menu-->
                </div>
                <!--end::Action-->
              </div>
              <!--end::Info-->
              <!--begin::Customer-->
              <div class="d-flex flex-stack">
                <!--begin::Name-->
                <span class="text-gray-400 fw-bold">To:
                <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Dan Wilson</a></span>
                <!--end::Name-->
                <!--begin::Label-->
                <span class="badge badge-light-danger">Confirmed</span>
                <!--end::Label-->
              </div>
              <!--end::Customer-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
              <!--begin::Info-->
              <div class="d-flex flex-stack mb-3">
                <!--begin::Wrapper-->
                <div class="me-3">
                  <!--begin::Icon-->
                  <img src="assets/media/stock/ecommerce/211.gif" class="w-50px ms-n1 me-1" alt="" />
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Elephant 1802</a>
                  <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Action-->
                <div class="m-0">
                  <!--begin::Menu-->
                  <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                    <span class="svg-icon svg-icon-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </button>
                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Ticket</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Customer</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                      <!--begin::Menu item-->
                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                      </a>
                      <!--end::Menu item-->
                      <!--begin::Menu sub-->
                      <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                      </div>
                      <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Contact</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mt-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                      </div>
                    </div>
                    <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->
                  <!--end::Menu-->
                </div>
                <!--end::Action-->
              </div>
              <!--end::Info-->
              <!--begin::Customer-->
              <div class="d-flex flex-stack">
                <!--begin::Name-->
                <span class="text-gray-400 fw-bold">To:
                <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Lebron Wayde</a></span>
                <!--end::Name-->
                <!--begin::Label-->
                <span class="badge badge-light-success">Delivered</span>
                <!--end::Label-->
              </div>
              <!--end::Customer-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
              <!--begin::Info-->
              <div class="d-flex flex-stack mb-3">
                <!--begin::Wrapper-->
                <div class="me-3">
                  <!--begin::Icon-->
                  <img src="assets/media/stock/ecommerce/215.gif" class="w-50px ms-n1 me-1" alt="" />
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">RiseUP</a>
                  <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Action-->
                <div class="m-0">
                  <!--begin::Menu-->
                  <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                    <span class="svg-icon svg-icon-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </button>
                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Ticket</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Customer</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                      <!--begin::Menu item-->
                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                      </a>
                      <!--end::Menu item-->
                      <!--begin::Menu sub-->
                      <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                      </div>
                      <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Contact</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mt-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                      </div>
                    </div>
                    <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->
                  <!--end::Menu-->
                </div>
                <!--end::Action-->
              </div>
              <!--end::Info-->
              <!--begin::Customer-->
              <div class="d-flex flex-stack">
                <!--begin::Name-->
                <span class="text-gray-400 fw-bold">To:
                <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Ana Simmons</a></span>
                <!--end::Name-->
                <!--begin::Label-->
                <span class="badge badge-light-primary">Shipping</span>
                <!--end::Label-->
              </div>
              <!--end::Customer-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="border border-dashed border-gray-300 rounded px-7 py-3">
              <!--begin::Info-->
              <div class="d-flex flex-stack mb-3">
                <!--begin::Wrapper-->
                <div class="me-3">
                  <!--begin::Icon-->
                  <img src="assets/media/stock/ecommerce/192.gif" class="w-50px ms-n1 me-1" alt="" />
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Yellow Stone</a>
                  <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Action-->
                <div class="m-0">
                  <!--begin::Menu-->
                  <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                    <span class="svg-icon svg-icon-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </button>
                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Ticket</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Customer</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                      <!--begin::Menu item-->
                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                      </a>
                      <!--end::Menu item-->
                      <!--begin::Menu sub-->
                      <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                      </div>
                      <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <a href="#" class="menu-link px-3">New Contact</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mt-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                      </div>
                    </div>
                    <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->
                  <!--end::Menu-->
                </div>
                <!--end::Action-->
              </div>
              <!--end::Info-->
              <!--begin::Customer-->
              <div class="d-flex flex-stack">
                <!--begin::Name-->
                <span class="text-gray-400 fw-bold">To:
                <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Kevin Leonard</a></span>
                <!--end::Name-->
                <!--begin::Label-->
                <span class="badge badge-light-danger">Confirmed</span>
                <!--end::Label-->
              </div>
              <!--end::Customer-->
            </div>
            <!--end::Item-->
          </div>
          <!--end::Scroll-->
        </div>
        <!--end::Body-->
      </div>
      <!--end::List widget 5-->
    </div>
    
  </div>
  <!--end::Row-->
</div>
@endsection