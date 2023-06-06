<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="newCoalModalRef"
    id="kt_add_modal_coal"
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
                <h2 class="fw-bold">Add Data Coal</h2>
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
              id="kt_add_modal_coal_scroll"
            >
                
                    <input :value="text" style="border:white;"/>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" type="select" v-slot="{ value, field, errorMessage }">
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
                        <el-col :span="12">
                            <Field name="pabrik" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Pabrik" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in pabrik_options"
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
                            <Field name="sumber_emisi" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Nama Sumber Emisi" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in sumberemisi_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>

                        <el-col :span="12">
                            <Field name="tipe_batubara" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Tipe Batubara" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
                                <el-option
                                    v-for="item in tipebatubara_options"
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
                        <el-col :span="7">
                            <Field name="consumption_mmbtu" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Consumption MMBTU" required>
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

                    <!-- <el-row :gutter="20">
                        <el-col :span="8">
                            <Field name="pabrik" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Pabrik" required>
                                <el-input
                                placeholder="Nama Pabrik"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>

                        <el-col :span="8">
                            <Field name="sumber_emisi" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Nama Sumber Emisi" required>
                                <el-input
                                placeholder="Sumber Emisi"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                        
                        <el-col :span="8">
                            <Field name="tipe_batubara" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Tipe Batubara" required>
                                <el-input
                                placeholder="Tipe Batubara"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="7">
                            <Field name="consumption_mmbtu" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Consumption MMBTU" required>
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="10">
                            <Field name="conversion_on_factor" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Conversion on Factor(TJ/MMBTU)" required>
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="7">
                            <Field name="consumption_tj" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Consumption TJ" required>
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
                            <Field name="co2_emissions_factor" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Emissions Factor" required>
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
                            <Field name="co2_emissions" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Emissions" required>
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
                            <Field name="ch4_emissions_factor" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CH4 Emissions Factor" required>
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
                            <Field name="ch4_emissions" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CH4 Emissions" required>
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
                            <Field name="n2o_emissions_factor" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="N2O Emissions Factor" required>
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
                            <Field name="n2o_emissions" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="N2O Emissions" required>
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
                            <Field name="co2eq" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2eq" required>
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row> -->
                
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
    data() {
        return {
            loading:false,
            coal: {
                file: ''
            },
            tahun_options: [],
            pabrik_options: [],
            sumberemisi_options: [],
            tipebatubara_options: [],
        }
    },
    setup() {
        const schema = yup.object({
            tahun: yup.string().required().label('Tahun'),
            pabrik: yup.string().required().label('Pabrik'),
            sumber_emisi: yup.string().required().label('Nama Sumber Emisi'),
            tipe_batubara: yup.string().required().label('Tipe Batubara'),
            consumption_mmbtu: yup.number().required().label('Consumption MMBTU'),
            // conversion_on_factor: yup.number().required().label('Conversion on Factor(TJ/MMBTU)'),
            // consumption_tj: yup.number().required().label('Consumption TJ'),
            // co2_emissions_factor: yup.number().required().label('CO2 Emissions Factor'),
            // co2_emissions: yup.number().required().label('CO2 Emissions'),
            // ch4_emissions_factor: yup.number().required().label('CH4 Emissions Factor'),
            // ch4_emissions: yup.number().required().label('CH4 Emissions'),
            // n2o_emissions_factor: yup.number().required().label('N2O Emissions Factor'),
            // n2o_emissions: yup.number().required().label('N2O Emissions'),
            // co2eq: yup.number().required().label('CO2eq'),
            });
        return {
            schema,
        };
    },
    created() {
        this.fetchTahun();
        this.fetchPabrik();
        this.fetchSumberEmisi();
        this.fetchTipeBatubara();
    },
    methods: {
        async onSubmit(values, actions) {
            this.loading = true;
            // console.log(JSON.stringify(values, null, 2));

            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/coal/add',values).then(response=>{
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
                        $('#kt_add_modal_coal').modal('hide');
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
                        $('#kt_add_modal_coal').modal('hide');
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
                        // $('#kt_add_modal_coal').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
        fetchTahun() {
            axios.get(`/api/valuelist/gettahundata`)
                .then(response => {
                    this.tahun_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        fetchPabrik() {
            axios.get(`/api/valuelist/getpabrikdata`)
                .then(response => {
                    this.pabrik_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        fetchSumberEmisi() {
            axios.get(`/api/valuelist/getsumberemisidata`)
                .then(response => {
                    this.sumberemisi_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        fetchTipeBatubara() {
            axios.get(`/api/valuelist/gettipebatubaradata`)
                .then(response => {
                    this.sumberemisi_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    }
}
</script>
