<table class="table align-middle table-row-dashed fs-6 gy-5">
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-semibold">
        <!--begin::Table row-->
        <tr>
            <td class="text-gray-800">
                Administrator Access
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                    title="Allows a full access to the system"></i>
            </td>
            <td>
                <!--begin::Checkbox-->
                <label class="form-check form-check-custom form-check-solid me-9">
                    <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                    <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                </label>
                <!--end::Checkbox-->
            </td>
        </tr>

        <!--end::Table row-->
        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Campaign Leads</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="campaign-leads-list" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('campaign-leads-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="campaign-leads-create"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('campaign-leads-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Create</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="campaign-leads-edit" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('campaign-leads-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="campaign-leads-delete"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('campaign-leads-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="campaign-leads-import"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('campaign-leads-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Import</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="campaign-leads-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('campaign-leads-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="campaign-leads-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('campaign-leads-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">After Sale Leads</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-leads-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-leads-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-leads-create"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-leads-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Create</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-leads-edit"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-leads-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-leads-delete"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-leads-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-leads-import"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-leads-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Import</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-leads-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-leads-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="after-sale-leads-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-leads-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Used Car Leads</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="used-car-leads-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('used-car-leads-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="used-car-leads-create"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('used-car-leads-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Create</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="used-car-leads-edit"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('used-car-leads-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="used-car-leads-delete"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('used-car-leads-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="used-car-leads-import"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('used-car-leads-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Import</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="used-car-leads-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('used-car-leads-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="used-car-leads-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('used-car-leads-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Smo Leads</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="smo-leads-list" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('smo-leads-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="smo-leads-create" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('smo-leads-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Create</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="smo-leads-edit" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('smo-leads-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="smo-leads-delete" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('smo-leads-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="smo-leads-import" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('smo-leads-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Import</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="smo-leads-export" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('smo-leads-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="smo-leads-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('smo-leads-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Google Business</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="google-business-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('google-business-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="google-business-create" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('google-business-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="google-business-edit"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('google-business-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="google-business-delete"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('google-business-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="google-business-import"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('google-business-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Import</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="google-business-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('google-business-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="google-business-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('google-business-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Old Leads</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="old-leads-list" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('old-leads-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="old-leads-create" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('old-leads-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Create</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="old-leads-edit" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('old-leads-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="old-leads-delete" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('old-leads-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="old-leads-import" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('old-leads-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Import</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="old-leads-export" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('old-leads-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="old-leads-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('old-leads-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Sale Data</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sales-data-list" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sales-data-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sales-data-create" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sales-data-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sales-data-edit" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sales-data-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sales-data-delete"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sales-data-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sales-data-import"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sales-data-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Import</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sales-data-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sales-data-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="sales-data-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sales-data-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Social Data</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="social-data-list" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('social-data-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="social-data-create"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('social-data-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Create</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="social-data-edit" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('social-data-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Edit</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="social-data-delete"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('social-data-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Delete</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="social-data-import" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('social-data-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="social-data-export" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('social-data-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Export</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="social-data-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('social-data-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->
        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Sale Graph</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-list" name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-create" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-edit" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-delete" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Delete</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-import" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="sale-graph-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Sale Graph Comparison</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-comparison-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-comparison-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-comparison-create" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-comparison-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-comparison-edit" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-comparison-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-comparison-delete" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-comparison-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Delete</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-comparison-import" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-comparison-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="sale-graph-comparison-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-comparison-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="sale-graph-comparison-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('sale-graph-comparison-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">After Sale Graph</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-create" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-edit" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-delete" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Delete</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-import" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->
        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">After Sale Graph Comparison</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-comparison-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-comparison-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-comparison-create"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-comparison-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-comparison-edit"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-comparison-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-comparison-delete"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-comparison-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Delete</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-comparison-import"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-comparison-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-comparison-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-comparison-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="after-sale-graph-comparison-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('after-sale-graph-comparison-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Test Drive Graph</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="test-drive-graph-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('test-drive-graph-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="test-drive-graph-create" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('test-drive-graph-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="test-drive-graph-edit" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('test-drive-graph-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="test-drive-graph-delete" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('test-drive-graph-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Delete</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="test-drive-graph-import" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('test-drive-graph-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="test-drive-graph-list-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('test-drive-graph-list-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="test-drive-graph-list-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('test-drive-graph-list-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->
        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Online Service Booking Graph</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="online-service-booking-graph-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('online-service-booking-graph-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="online-service-booking-graph-create"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('online-service-booking-graph-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="online-service-booking-graph-edit"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('online-service-booking-graph-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="online-service-booking-graph-delete"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('online-service-booking-graph-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Delete</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="online-service-booking-graph-import"
                            disabled name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('online-service-booking-graph-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="online-service-booking-graph-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('online-service-booking-graph-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="online-service-booking-graph-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('online-service-booking-graph-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

        <!--begin::Table row-->
        <tr>
            <!--begin::Label-->
            <td class="text-gray-800">Service Offers Graph</td>
            <!--end::Label-->
            <!--begin::Options-->
            <td>
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="service-offers-graph-list"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('service-offers-graph-list', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Listing</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="service-offers-graph-create" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('service-offers-graph-create', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Create</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="service-offers-graph-edit" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('service-offers-graph-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="service-offers-graph-delete" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('service-offers-graph-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Delete</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="service-offers-graph-import" disabled
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('service-offers-graph-import', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="badge-light-danger"><span
                                class="form-check-label"><del>Import</del></span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                        <input class="form-check-input" type="checkbox" value="service-offers-graph-export"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('service-offers-graph-export', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Export</span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="service-offers-graph-filters"
                            name="permission[]"
                            {{ !empty($rolePermissionsArr) && in_array('service-offers-graph-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                        <span class="form-check-label">Filters</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Wrapper-->
            </td>
            <!--end::Options-->
        </tr>
        <!--end::Table row-->

      <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Contact Us Graph</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-us-graph-list"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('contact-us-graph-list', $rolePermissionsArr) ? 'checked' : '' }} />
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-us-graph-create"
                    disabled name="permission[]" {{ !empty($rolePermissionsArr) && in_array('contact-us-graph-create', $rolePermissionsArr) ? 'checked' : '' }} />
                <span class="badge-light-danger"><span
                        class="form-check-label"><del>Create</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-us-graph-edit"
                    disabled name="permission[]" {{ !empty($rolePermissionsArr) && in_array('contact-us-graph-edit', $rolePermissionsArr) ? 'checked' : '' }} />
                <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-us-graph-delete"
                    disabled name="permission[]" {{ !empty($rolePermissionsArr) && in_array('contact-us-graph-delete', $rolePermissionsArr) ? 'checked' : '' }} />
                <span class="badge-light-danger"><span
                        class="form-check-label"><del>Delete</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-us-graph-import"
                    disabled name="permission[]" {{ !empty($rolePermissionsArr) && in_array('contact-us-graph-import', $rolePermissionsArr) ? 'checked' : '' }} />
                <span class="badge-light-danger"><span
                        class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-us-graph-export"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('contact-us-graph-export', $rolePermissionsArr) ? 'checked' : '' }} />
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="contact-us-graph-filters"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('contact-us-graph-filters', $rolePermissionsArr) ? 'checked' : '' }} />
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

<!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Used Cars Graph</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="used-cars-graph-list"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('used-cars-graph-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="used-cars-graph-create" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('used-cars-graph-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Create</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="used-cars-graph-edit" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('used-cars-graph-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="used-cars-graph-delete" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('used-cars-graph-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Delete</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="used-cars-graph-import" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('used-cars-graph-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="used-cars-graph-export"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('used-cars-graph-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="used-cars-graph-filters"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('used-cars-graph-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

        <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Hr Graph</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="hr-graph-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('hr-graph-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="hr-graph-create" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('hr-graph-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Create</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="hr-graph-edit" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('hr-graph-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="hr-graph-delete" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('hr-graph-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Delete</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="hr-graph-import" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('hr-graph-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="hr-graph-export"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('hr-graph-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="hr-graph-filters"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('hr-graph-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

   <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">SMO Graph</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="smo-graph-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('smo-graph-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="smo-graph-create" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('smo-graph-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Create</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="smo-graph-edit" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('smo-graph-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="smo-graph-delete" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('smo-graph-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Delete</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="smo-graph-import" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('smo-graph-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="smo-graph-export"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('smo-graph-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="smo-graph-filters"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('smo-graph-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

<!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Events Graph</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="events-graph-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('events-graph-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="events-graph-create" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('events-graph-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Create</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="events-graph-edit" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('events-graph-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="events-graph-delete" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('events-graph-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Delete</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="events-graph-import" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('events-graph-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="events-graph-export"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('events-graph-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="events-graph-filters"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('events-graph-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

<!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Actual Sale Data Graph</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="actualsales-graph-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('actualsales-graph-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="actualsales-graph-create" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('actualsales-graph-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Create</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="actualsales-graph-edit" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('actualsales-graph-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Edit</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="actualsales-graph-delete" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('actualsales-graph-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Delete</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="actualsales-graph-import" disabled
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('actualsales-graph-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="actualsales-graph-export"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('actualsales-graph-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="actualsales-graph-filters"
                    name="permission[]" {{ !empty($rolePermissionsArr) && in_array('actualsales-graph-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

    <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Crm Leads</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="crm-leads-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('crm-leads-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="crm-leads-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('crm-leads-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="crm-leads-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('crm-leads-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="crm-leads-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('crm-leads-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="crm-leads-import" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('crm-leads-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Import</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="crm-leads-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('crm-leads-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="crm-leads-filters" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('crm-leads-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

  <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Contact</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('contact-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('contact-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('contact-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('contact-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('contact-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="contact-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('contact-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="contact-filters" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('contact-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Filters</span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->
  <!--begin::Table row-->
  <tr>
    <!--begin::Label-->
    <td class="text-gray-800">Users</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="users-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('users-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="users-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('users-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="users-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('users-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="users-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('users-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="users-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('users-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="users-export" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('users-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Export</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="users-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('users-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->
  <!--begin::Table row-->
  <tr>
    <!--begin::Label-->
    <td class="text-gray-800">Roles</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="role-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('role-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="role-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('role-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="role-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('role-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="role-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('role-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="role-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('role-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="role-export" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('role-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Export</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="role-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('role-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->
<!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Cities</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="city-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('city-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="city-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('city-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="city-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('city-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="city-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('city-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="city-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('city-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="city-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('city-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="city-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('city-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

        <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Branches</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="branch-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('branch-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="branch-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('branch-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="branch-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('branch-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="branch-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('branch-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="branch-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('branch-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="branch-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('branch-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="branch-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('branch-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

        <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Vehicles</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="vehicle-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('vehicle-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="vehicle-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('vehicle-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="vehicle-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('vehicle-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="vehicle-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('vehicle-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="vehicle-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('vehicle-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="vehicle-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('vehicle-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="vehicle-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('vehicle-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->
<!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Sources</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="source-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('source-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="source-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('source-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="source-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('source-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="source-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('source-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="source-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('source-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="source-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('source-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="source-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('source-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

    <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Campaigns</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="campaign-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('campaign-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="campaign-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('campaign-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="campaign-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('campaign-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="campaign-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('campaign-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="campaign-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('campaign-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="campaign-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('campaign-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="campaign-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('campaign-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

 <!--begin::Table row-->
<tr>
    <!--begin::Label-->
    <td class="text-gray-800">Banks</td>
    <!--end::Label-->
    <!--begin::Options-->
    <td>
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between">
            <!--begin::Checkbox for Listing-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="bank-list" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('bank-list', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Listing</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Create-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="bank-create" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('bank-create', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Create</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Edit-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="bank-edit" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('bank-edit', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Edit</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Delete-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="bank-delete" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('bank-delete', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Delete</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Import-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="bank-import" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('bank-import', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Import</del></span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Export-->
            <label class="form-check form-check-sm form-check-custom form-check-solid me-2">
                <input class="form-check-input" type="checkbox" value="bank-export" name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('bank-export', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="form-check-label">Export</span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Checkbox for Filters-->
            <label class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="bank-filters" disabled name="permission[]"
                    {{ !empty($rolePermissionsArr) && in_array('bank-filters', $rolePermissionsArr) ? 'checked' : '' }}>
                <span class="badge-light-danger"><span class="form-check-label"><del>Filters</del></span></span>
            </label>
            <!--end::Checkbox-->
        </div>
        <!--end::Wrapper-->
    </td>
    <!--end::Options-->
</tr>
<!--end::Table row-->

    </tbody>
    <!--end::Table body-->
</table>
