<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="editDistribusiKapalModalRef"
    id="kt_edit_modal_distribusikapal"
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
                <h2 class="fw-bold">Edit Data Distribusi Kapal</h2>
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
              id="kt_edit_modal_distribusikapal_scroll"
            >
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" type="select" v-model="distribusikapal.tahun" v-slot="{ value, field, errorMessage }">
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
                        <el-col :span="7">
                            <Field name="consumption_liter" type="number" v-model="distribusikapal.consumption_liter" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Consumption Liter" required>
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
                            <Field name="conversion_factor" type="number" v-model="distribusikapal.conversion_factor" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Conversion Factor(TJ/Liter)" required>
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
                            <Field name="consumption_tj" type="number" v-model="distribusikapal.consumption_tj" v-slot="{ value, field, errorMessage }">
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
                            <Field name="co2_emission_factor" type="number" v-model="distribusikapal.co2_emission_factor" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Emission Factor" required>
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
                            <Field name="co2_emission" type="number" v-model="distribusikapal.co2_emission" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Emission" required>
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
                            <Field name="ch4_emission_factor" type="number" v-model="distribusikapal.ch4_emission_factor" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CH4 Emission Factor" required>
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
                            <Field name="ch4_emission" type="number" v-model="distribusikapal.ch4_emission" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CH4 Emission" required>
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
                            <Field name="n2o_emission_factor" type="number" v-model="distribusikapal.n2o_emission_factor" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="N2O Emission Factor" required>
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
                            <Field name="n2o_emission" type="number" v-model="distribusikapal.n2o_emission" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="N2O Emission" required>
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
                            <Field name="ton_co2eq" type="number" v-model="distribusikapal.ton_co2eq" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Ton CO2eq" required>
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
                            <Field name="kg_co2eq" type="number" v-model="distribusikapal.kg_co2eq" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Kg CO2eq" required>
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
    props: ["detaildistribusikapal"],
    data() {
        return {
            loading:false,
            value:"tes",
            distribusikapal: {
                id: "",
                tahun: "",
                consumption_liter: "",
                conversion_factor: "",
                consumption_tj: "",
                co2_emission_factor: "",
                co2_emission: "",
                ch4_emission_factor: "",
                ch4_emission: "",
                n2o_emission_factor: "",
                n2o_emission: "",
                ton_co2eq: "",
                kg_co2eq: "",
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
            consumption_liter: yup.number().required().label('Consumption Liter'),
            conversion_factor: yup.number().required().label('Conversion Factor(TJ/Liter)'),
            consumption_tj: yup.number().required().label('Consumption TJ'),
            co2_emission_factor: yup.number().required().label('CO2 Emission Factor'),
            co2_emission: yup.number().required().label('CO2 Emission'),
            ch4_emission_factor: yup.number().required().label('CH4 Emission Factor'),
            ch4_emission: yup.number().required().label('CH4 Emission'),
            n2o_emission_factor: yup.number().required().label('N2O Emission Factor'),
            n2o_emission: yup.number().required().label('N2O Emission'),
            ton_co2eq: yup.number().required().label('Ton CO2eq'),
            kg_co2eq: yup.number().required().label('Kg CO2eq'),
            });
        return {
            schema,
        };
    },
    watch: {
        detaildistribusikapal: {
            handler(val, old) {
                this.distribusikapal.id = val.id;
                this.distribusikapal.tahun = val.tahun;
                this.distribusikapal.pabrik = val.pabrik;
                this.distribusikapal.sumber_emisi = val.sumber_emisi;
                this.distribusikapal.consumption_liter = val.consumption_liter;
                this.distribusikapal.conversion_factor = val.conversion_factor;
                this.distribusikapal.consumption_tj = val.consumption_tj;
                this.distribusikapal.co2_emission_factor = val.CO2_emission_factor;
                this.distribusikapal.co2_emission = val.CO2_emission;
                this.distribusikapal.ch4_emission_factor = val.CH4_emission_factor;
                this.distribusikapal.ch4_emission = val.CH4_emission;
                this.distribusikapal.n2o_emission_factor = val.N2O_emission_factor;
                this.distribusikapal.n2o_emission = val.N2O_emission;
                this.distribusikapal.ton_co2eq = val.ton_CO2eq;
                this.distribusikapal.kg_co2eq = val.kg_CO2eq;
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
            await axios.post(`/api/distribusikapal/update/${this.distribusikapal.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_distribusikapal').modal('hide');
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
                        $('#kt_edit_modal_distribusikapal').modal('hide');
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
                        // $('#kt_edit_modal_distribusikapal').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
    }
}
</script>
