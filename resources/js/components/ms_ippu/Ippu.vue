<template>
    <div class="d-flex flex-column flex-column-fluid">
		<!--begin::Toolbar-->
		<div id="kt_app_toolbar" class="app-toolbar d-flex flex-stack py-4 py-lg-8">
			<!--begin::Toolbar wrapper-->
			<div class="d-flex flex-grow-1 flex-stack flex-wrap gap-2 mb-n10" id="kt_toolbar">
				<!--begin::Page title-->
				<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
					<!--begin::Title-->
					<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Ippu</h1>
					<!--end::Title-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
						<!--begin::Item-->
						<li class="breadcrumb-item text-muted">
							<a href="/" class="text-muted text-hover-primary">Home</a>
						</li>
						<!--end::Item-->
						<!--begin::Item-->
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-400 w-5px h-2px"></span>
						</li>
						<!--end::Item-->
						<!--begin::Item-->
						<li class="breadcrumb-item text-dark">Ippu</li>
						<!--end::Item-->
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page title-->
        <!--begin::Actions-->
				<div class="d-flex align-items-center pt-4 pb-7 pt-lg-1 pb-lg-2">
					<!--begin::Button-->
          <button type="button" class="btn btn-sm btn-primary fw-bold me-3" @click="importIppu">
            <span><i class="cursor-pointer dx-icon-plus"></i>Import Data</span>
          </button>
					<!--end::Button-->
					<!--begin::Button-->
					<button type="button" class="btn btn-sm btn-primary fw-bold me-3" @click="addIppu">
            <span><i class="cursor-pointer dx-icon-plus"></i>Add Data</span>
          </button>
					<!--end::Button-->
				</div>
				<!--end::Actions-->
			</div>
			<!--end::Toolbar wrapper-->
		</div>
		<!--end::Toolbar-->
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
      <DxDataGrid
          id="gridContainerIppu"
          ref="dataGrid"
          key-expr="id"
          :data-source="dataSourceIppu"
          @editor-preparing="onEditorPreparing"
          @init-new-row="onInitNewRow"
          :remote-operations="true"
          :allow-column-reordering="true"
          :allow-column-resizing="true"
          :column-auto-width="true"
          :row-alternation-enabled="true"
      >
      <DxEditing
        :allow-updating="true"
        :allow-deleting="allowDeleting"
        :use-icons="true"
        mode="row"
      />
      <DxColumnFixing :enabled="true"/>
          <DxColumn
            type="buttons"
            :fixed="true"
            fixed-position="left"
            :width="110"
          >
            <DxButton
              hint="Edit"
              icon="edit"
              @click="editIppu"
            />
            <DxButton
              name="delete"
              hint="Delete"
              icon="trash"
              @click="deleteIppu"
            />
          </DxColumn>
          <DxColumn
          data-field="tahun"
          data-type="string"
          fixed-position="left"
          :fixed="true"
          />
          <DxColumn
          data-field="sumber_emisi"
          data-type="string"
          fixed-position="left"
          :fixed="true"
          />
          <DxColumn
          data-field="amount_of_ammonia_produced"
          data-type="string"
          />
          <DxColumn
          data-field="fuel_requirement_for_ammonia_production"
          data-type="string"
          />
          <DxColumn
          data-field="carbon_content_of_fuel"
          data-type="string"
          />
          <DxColumn
          data-field="carbon_oxidation_factor_of_fuel"
          data-type="string"
          />
          <DxColumn
          data-field="CO2_generated"
          data-type="string"
          />
          <DxColumn
          data-field="amount_of_urea_produced"
          data-type="string"
          />
          <DxColumn
          data-field="CO2_recovered_for_urea_production"
          data-type="string"
          />
          <DxColumn
          data-field="CO2_recovered_for_urea"
          data-type="string"
          />
          <DxColumn
          data-field="CO2_emissions"
          data-type="string"
          />
          <DxFilterRow :visible="true"/>
          <DxHeaderFilter :visible="true"/>
          <DxGroupPanel :visible="true"/>
          <DxPaging :page-size="10"/>
          <DxPager
          :show-page-size-selector="true"
          :allowed-page-sizes="[7, 10, 20]"
          />
          <DxScrolling
            :use-native="true"
            :scroll-by-content="true"
            :scroll-by-thumb="true"
            show-scrollbar="onHover" />
      </DxDataGrid>
		</div>
		<!--end::Content-->
	</div>

  <ImportModalIppu @refreshGridParent="refreshGrid"></ImportModalIppu>
  <AddModalIppu @refreshGridParent="refreshGrid"></AddModalIppu>
  <EditModalIppu @refreshGridParent="refreshGrid" :detailippu="detailippu"></EditModalIppu>
</template>

<script>

import {
        DxDataGrid, 
        DxColumn, 
        DxPaging, 
        DxPager,DxHeaderFilter, 
        DxFilterRow, 
        DxButton, 
        DxEditing,
        DxLookup,
        DxScrolling
} from 'devextreme-vue/data-grid';
import CustomStore from 'devextreme/data/custom_store';
import axios from 'axios';
import { confirm } from 'devextreme/ui/dialog';
import ImportModalIppu from "./ImportIppu.vue";
import AddModalIppu from "./AddIppu.vue";
import EditModalIppu from "./EditIppu.vue";

const is_exporting = false;
const storeIppu = new CustomStore({
  key: 'id',
  load(loadOptions) {
    const args = {_token: $('meta[name="csrf-token"]').attr('content')};
    [
      'skip',
      'take',
      'requireTotalCount',
      'requireGroupCount',
      'sort',
      'filter',
      'totalSummary',
      'group',
      'groupSummary',
    ];
    if (loadOptions.sort) {
        //console.log(loadOptions.sort);
        args.orderby = loadOptions.sort[0].selector;
        if (loadOptions.sort[0].desc)
            args.sort = "desc";
        if (loadOptions.sort[0].desc == false)
            args.sort = "asc";
    }
    if (!is_exporting){
        args.skip = loadOptions.skip || 0;
        args.take = loadOptions.take || 10;
    }
    args.filter = loadOptions.filter;
    return axios.post('/api/ippu/loadippu', args)
                    .then(response => ({
                      data: response.data.data,
                      totalCount: response.data.totalCount,
                      summary: response.data.summary,
                      groupCount: response.data.groupCount,
                    }))
                    .catch(function (error) {
                        console.error(error);
                    });
  },
});


export default {
    components: {
        DxDataGrid, 
        DxColumn, 
        DxPaging, 
        DxPager,DxHeaderFilter, 
        DxFilterRow, 
        DxButton, 
        DxEditing,
        DxLookup,
        DxScrolling,
        ImportModalIppu,
        AddModalIppu,
        EditModalIppu,
    },
    data() {
        return {
            dataSourceIppu: storeIppu,
            detailippu: []
        }
    },
    created() {
    },
    mounted(){
      this.$root.active_el = 'master';
    },
    methods: {
        refreshGrid(e) {
          this.$refs.dataGrid.instance.state(null);
        },
        addIppu(){
          $('#kt_add_modal_ippu').modal('show');
        },
        importIppu(){
          $('#kt_import_modal_ippu').modal('show');
        },
        allowDeleting(e) {
          return true;
        },
        allowEdit(e) { //button grid action edit
          // return e.row.data.visibleedit;
          return true;
        },
        deleteIppu(e) {
          let id = e.row.data.id;
          let result = confirm("<i>Are you sure?</i>", "Confirm changes");
          result.then((dialogResult) => {
            if(dialogResult){
              axios.get('/sanctum/csrf-cookie')
              axios.delete(`/api/ippu/delete/${id}`).then(response=>{
                //refresh grid
                this.$refs.dataGrid.instance.state(null);
              }).catch(function (error) {
                console.error(error);
              });
            }
          });
        },
        editIppu(e) {
          console.log(e.row.data.id);
          let id = e.row.data.id
          $('#kt_edit_modal_ippu').modal('show');
          axios.get('/sanctum/csrf-cookie')
          axios.get(`/api/ippu/edit/${id}`)
                .then(response => {
                    this.detailippu = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    }
}
</script>