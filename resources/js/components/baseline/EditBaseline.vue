<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="editBaselineModalRef"
    id="kt_edit_modal_baseline"
    tabindex="0"
    aria-hidden="true"
  >
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
      <!--begin::Modal content-->
      <div class="modal-content">
          <!--begin::Modal header-->
          <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Data Baseline</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
          </div>
          <!--end::Modal header-->

          <Form as="el-form" class="el-form--label-top" :validation-schema="schema" @submit="onSubmit">
          <!--begin::Modal body-->
          <div class="modal-body py-7 px-lg-17">
            <!--begin::Scroll-->
            <div
              class="scroll-y me-n7 pe-7"
              id="kt_edit_modal_baseline_scroll"
            >
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="emission" v-model="baseline.emission" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Emission" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in emission_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="inventory" v-model="baseline.inventory" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Inventory" required>
                                <el-input
                                placeholder="-"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="sector" v-model="baseline.sector" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Sector" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in sector_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="scope" v-model="baseline.scope" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Scope" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in scope_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="category" v-model="baseline.category" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Category" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in category_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="tahun" v-model="baseline.tahun" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Tahun" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in tahun_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="business_as_usual" v-model="baseline.business_as_usual" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Business as usual" required>
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="pengurangan_emisi_CO2" v-model="baseline.pengurangan_emisi_CO2" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Pengurangan Emisi CO2">
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="penambahan_emisi_CO2" v-model="baseline.penambahan_emisi_CO2" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Penambahan Emisi CO2">
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="realisasi_pengurangan_emisi_CO2" v-model="baseline.realisasi_pengurangan_emisi_CO2" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Realisasi Pengurangan Emisi CO2">
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="realisasi_penambahan_emisi_CO2" v-model="baseline.realisasi_penambahan_emisi_CO2" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Realisasi Penambahan Emisi CO2">
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>
                
            </div>
            <!--end::Scroll-->
          </div>
          <!--end::Modal body-->

          <!--begin::Modal footer-->
          <div class="modal-footer">
            <!--begin::Button-->
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between container-fluid">
                <div>
                    <button id="modal_dismiss" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    <span><i class="cursor-pointer dx-icon-close"></i>cancel</span>
                    </button>
                </div>
                <!--end::Button-->

                <!--begin::Button-->
                <div>
                    <el-button type="primary" :disabled="loading" native-type="submit">{{ loading ? "Please wait" : "Submit" }}</el-button>
                </div>
            </div>
            <!--end::Button-->
          </div>
          <!--end::Modal footer-->
        </Form>
      </div>
    </div>
  </div>
  <!--end::Modal - New Address-->
</template>

<script>

import Swal from "sweetalert2/dist/sweetalert2.js";
import { Field, Form } from 'vee-validate';
import * as yup from 'yup';

export default {
    components: {
        Field, Form
    },
    props: ["detailbaseline"],
    data() {
        return {
            loading:false,
            baseline: {
                emission: "",
                inventory: "",
                sector: "",
                scope: "",
                category: "",
                tahun: "",
                business_as_usual: "",
                pengurangan_emisi_CO2: "",
                penambahan_emisi_CO2: "",
                realisasi_pengurangan_emisi_CO2: "",
                realisasi_penambahan_emisi_CO2: ""
            },
            emission_options: [
              {
                value: 'Direct Emission',
                label: 'Direct Emission',
              },
              {
                value: 'Indirect Emission',
                label: 'Indirect Emission',
              },
              {
                value: 'Other',
                label: 'Other',
              }
            ],
            sector_options: [
              {
                value: 'Energy',
                label: 'Energy',
              },
              {
                value: 'IPPU',
                label: 'IPPU',
              },
              {
                value: 'Refrigerant',
                label: 'Refrigerant',
              },
              {
                value: 'AFOLU',
                label: 'AFOLU',
              },
              {
                value: 'Limbah ',
                label: 'Limbah ',
              }
            ],
            scope_options: [
              {
                value: '1',
                label: '1',
              },
              {
                value: '2',
                label: '2',
              },
              {
                value: '3',
                label: '3',
              }
            ],
            tahun_options: [
              {
                value: '2021',
                label: '2021',
              },
              {
                value: '2022',
                label: '2022',
              },
              {
                value: '2023',
                label: '2023',
              },
              {
                value: '2024',
                label: '2024',
              },
              {
                value: '2025',
                label: '2025',
              },
            ],
            category_options: []
        }
    },
    setup() {
        const schema = yup.object({
            emission: yup.string().required().label('Emission'),
            inventory: yup.string().required().label('Inventory'),
            sector: yup.string().required().label('Sector'),
            scope: yup.string().required().label('Scope'),
            category: yup.string().required().label('Category'),
            tahun: yup.string().required().label('Tahun'),
            business_as_usual: yup.string().required().label('Business as usual')
            // pengurangan_emisi_CO2: yup.number().required().label('Pengurangan Emisi CO2'),
            // penambahan_emisi_CO2: yup.number().required().label('Penambahan Emisi CO2'),
            // realisasi_pengurangan_emisi_CO2: yup.number().required().label('Realisasi Pengurangan Emisi CO2'),
            // realisasi_penambahan_emisi_CO2: yup.number().required().label('Realisasi Penambahan Emisi CO2')
            });
        return {
            schema,
        };
    },
    watch: {
        detailbaseline: {
            handler(val, old) {
                this.baseline.id = val.id;
                this.baseline.emission = val.emission;
                this.baseline.inventory = val.inventory;
                this.baseline.sector = val.sector;
                this.baseline.scope = val.scope;
                // this.baseline.category = val.category;
                this.baseline.category = val.category_desc;
                this.baseline.tahun = val.tahun;
                this.baseline.business_as_usual = val.business_as_usual;
                this.baseline.pengurangan_emisi_CO2 = val.pengurangan_emisi_CO2;
                this.baseline.penambahan_emisi_CO2 = val.penambahan_emisi_CO2;
                this.baseline.realisasi_pengurangan_emisi_CO2 = val.realisasi_pengurangan_emisi_CO2;
                this.baseline.realisasi_penambahan_emisi_CO2 = val.realisasi_penambahan_emisi_CO2;
            },
        },
    },
    created() {
        this.fetchCategory();
    },
    methods: {
        async onSubmit(values, actions) {
            this.loading = true;
            // console.log(JSON.stringify(values, null, 2));

            await axios.get('/sanctum/csrf-cookie')
            await axios.post(`/api/baseline/update/${this.baseline.id}`,values).then(response=>{
                  if(response.data['messageinput'] == 1){
                    Swal.fire({
                        text: response.data['message'],
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then(() => {
                        this.$emit('refreshGridParent')
                        $('#kt_edit_modal_baseline').modal('hide');
                        actions.resetForm();
                    });
                  }else{
                    Swal.fire({
                        text: response.data['message'],
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-danger",
                        },
                    }).then(() => {
                        $('#kt_edit_modal_baseline').modal('hide');
                    });
                  }  
            }).catch(({response})=>{
                Swal.fire({
                        text: response.data['message'],
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-danger",
                        },
                    }).then(() => {
                        // $('#kt_edit_modal_baseline').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
        fetchCategory() {
            axios.get('/sanctum/csrf-cookie')
            axios.get(`/api/baseline/getcategorydata`)
                .then(response => {
                    this.category_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    }
}
</script>
