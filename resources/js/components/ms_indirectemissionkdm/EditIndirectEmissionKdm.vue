<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="editIndirectEmissionKdmModalRef"
    id="kt_edit_modal_indirectemissionkdm"
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
                <h2 class="fw-bold">Edit Data Indirect Emission KDM</h2>
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
              id="kt_edit_modal_indirectemissionkdm_scroll"
            >
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" type="select" v-model="indirectemissionkdm.tahun" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Tahun" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" :filterable="true" placeholder="Select">
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
                            <Field name="pabrik" v-model="indirectemissionkdm.pabrik" v-slot="{ value, field, errorMessage }">
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

                        <el-col :span="12">
                            <Field name="sumber_emisi" v-model="indirectemissionkdm.sumber_emisi" v-slot="{ value, field, errorMessage }">
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
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="7">
                            <Field name="consumption_mmbtu" type="number" v-model="indirectemissionkdm.consumption_mmbtu" v-slot="{ value, field, errorMessage }">
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
                            <Field name="conversion_factor" type="number" v-model="indirectemissionkdm.conversion_on_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="consumption_tj" type="number" v-model="indirectemissionkdm.consumption_tj" v-slot="{ value, field, errorMessage }">
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
                            <Field name="co2_emissions_factor" type="number" v-model="indirectemissionkdm.co2_emissions_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="co2_emissions" type="number" v-model="indirectemissionkdm.co2_emissions" v-slot="{ value, field, errorMessage }">
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
                            <Field name="ch4_emissions_factor" type="number" v-model="indirectemissionkdm.ch4_emissions_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="ch4_emissions" type="number" v-model="indirectemissionkdm.ch4_emissions" v-slot="{ value, field, errorMessage }">
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
                            <Field name="n2o_emissions_factor" type="number" v-model="indirectemissionkdm.n2o_emissions_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="n2o_emissions" type="number" v-model="indirectemissionkdm.n2o_emissions" v-slot="{ value, field, errorMessage }">
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
                            <Field name="co2eq" type="number" v-model="indirectemissionkdm.co2eq" v-slot="{ value, field, errorMessage }">
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
    props: ["detailindirectemissionkdm"],
    data() {
        return {
            loading:false,
            value:"tes",
            indirectemissionkdm: {
                id: "",
                tahun: "",
                pabrik: "tes",
                sumber_emisi: "",
                consumption_mmbtu: "",
                consumption_tj: "",
                conversion_on_factor: "",
                co2_emissions_factor: "",
                co2_emissions: "",
                ch4_emissions_factor: "",
                ch4_emissions: "",
                n2o_emissions_factor: "",
                n2o_emissions: "",
                co2eq: "",
            },
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
        }
    },
    setup() {
        const schema = yup.object({
            tahun: yup.string().required().label('Tahun'),
            pabrik: yup.string().required().label('Pabrik'),
            sumber_emisi: yup.string().required().label('Nama Sumber Emisi'),
            consumption_mmbtu: yup.number().required().label('Consumption MMBTU'),
            conversion_factor: yup.number().required().label('Conversion on Factor(TJ/MMBTU)'),
            consumption_tj: yup.number().required().label('Consumption TJ'),
            co2_emissions_factor: yup.number().required().label('CO2 Emissions Factor'),
            co2_emissions: yup.number().required().label('CO2 Emissions'),
            ch4_emissions_factor: yup.number().required().label('CH4 Emissions Factor'),
            ch4_emissions: yup.number().required().label('CH4 Emissions'),
            n2o_emissions_factor: yup.number().required().label('N2O Emissions Factor'),
            n2o_emissions: yup.number().required().label('N2O Emissions'),
            co2eq: yup.number().required().label('CO2eq'),
            });
        return {
            schema,
        };
    },
    watch: {
        detailindirectemissionkdm: {
            handler(val, old) {
                this.indirectemissionkdm.id = val.id;
                this.indirectemissionkdm.tahun = val.tahun;
                this.indirectemissionkdm.pabrik = val.pabrik;
                this.indirectemissionkdm.sumber_emisi = val.sumber_emisi;
                this.indirectemissionkdm.consumption_mmbtu = val.consumption_mmbtu;
                this.indirectemissionkdm.consumption_tj = val.consumption_tj;
                this.indirectemissionkdm.conversion_on_factor = val.conversion_factor;
                this.indirectemissionkdm.co2_emissions_factor = val.CO2_emissions_factor;
                this.indirectemissionkdm.co2_emissions = val.CO2_emissions;
                this.indirectemissionkdm.ch4_emissions_factor = val.CH4_emissions_factor;
                this.indirectemissionkdm.ch4_emissions = val.CH4_emissions;
                this.indirectemissionkdm.n2o_emissions_factor = val.N2O_emissions_factor;
                this.indirectemissionkdm.n2o_emissions = val.N2O_emissions;
                this.indirectemissionkdm.co2eq = val.CO2eq;
            },
        },
    },
    created() {
    },
    methods: {
        async onSubmit(values, actions) {
            this.loading = true;
            // console.log(JSON.stringify(values, null, 2));

            await axios.get('/sanctum/csrf-cookie')
            await axios.post(`/api/indirectemissionkdm/update/${this.indirectemissionkdm.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_indirectemissionkdm').modal('hide');
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
                        $('#kt_edit_modal_indirectemissionkdm').modal('hide');
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
                        // $('#kt_edit_modal_indirectemissionkdm').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
    }
}
</script>
