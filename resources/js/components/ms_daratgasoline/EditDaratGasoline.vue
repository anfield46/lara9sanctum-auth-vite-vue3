<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="editDaratGasolineModalRef"
    id="kt_edit_modal_daratgasoline"
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
                <h2 class="fw-bold">Edit Data Darat Gasoline</h2>
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
              id="kt_edit_modal_daratgasoline_scroll"
            >
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" type="select" v-model="daratgasoline.tahun" v-slot="{ value, field, errorMessage }">
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
                            <Field name="energy_consumption_liter" type="number" v-model="daratgasoline.energy_consumption_liter" v-slot="{ value, field, errorMessage }">
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
                            <Field name="conversion_factor" type="number" v-model="daratgasoline.conversion_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="energy_consumption_tj" type="number" v-model="daratgasoline.energy_consumption_tj" v-slot="{ value, field, errorMessage }">
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
                            <Field name="co2_emission_factor" type="number" v-model="daratgasoline.co2_emission_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="co2_emission" type="number" v-model="daratgasoline.co2_emission" v-slot="{ value, field, errorMessage }">
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
                            <Field name="ch4_emission_factor" type="number" v-model="daratgasoline.ch4_emission_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="ch4_emission" type="number" v-model="daratgasoline.ch4_emission" v-slot="{ value, field, errorMessage }">
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
                            <Field name="n2o_emission_factor" type="number" v-model="daratgasoline.n2o_emission_factor" v-slot="{ value, field, errorMessage }">
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
                            <Field name="n2o_co2_emission" type="number" v-model="daratgasoline.n2o_co2_emission" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="N2O CO2 Emission" required>
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
                            <Field name="ton_co2eq" type="number" v-model="daratgasoline.ton_co2eq" v-slot="{ value, field, errorMessage }">
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
    props: ["detaildaratgasoline"],
    data() {
        return {
            loading:false,
            value:"tes",
            daratgasoline: {
                id: "",
                tahun: "",
                energy_consumption_liter: "",
                conversion_factor: "",
                energy_consumption_tj: "",
                co2_emission_factor: "",
                co2_emission: "",
                ch4_emission_factor: "",
                ch4_emission: "",
                n2o_emission_factor: "",
                n2o_co2_emission: "",
                ton_co2eq: "",
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
            energy_consumption_liter: yup.number().required().label('Energy Consumption Liter'),
            conversion_factor: yup.number().required().label('Conversion Factor(TJ/Liter)'),
            energy_consumption_tj: yup.number().required().label('Energy Consumption TJ'),
            co2_emission_factor: yup.number().required().label('CO2 Emission Factor'),
            co2_emission: yup.number().required().label('CO2 Emission'),
            ch4_emission_factor: yup.number().required().label('CH4 Emission Factor'),
            ch4_emission: yup.number().required().label('CH4 Emission'),
            n2o_emission_factor: yup.number().required().label('N2O Emission Factor'),
            n2o_co2_emission: yup.number().required().label('N2O CO2 Emission'),
            ton_co2eq: yup.number().required().label('Ton CO2eq'),
            });
        return {
            schema,
        };
    },
    watch: {
        detaildaratgasoline: {
            handler(val, old) {
                this.daratgasoline.id = val.id;
                this.daratgasoline.tahun = val.tahun;
                this.daratgasoline.pabrik = val.pabrik;
                this.daratgasoline.sumber_emisi = val.sumber_emisi;
                this.daratgasoline.energy_consumption_liter = val.energy_consumption_liter;
                this.daratgasoline.conversion_factor = val.conversion_factor;
                this.daratgasoline.energy_consumption_tj = val.energy_consumption_tj;
                this.daratgasoline.co2_emission_factor = val.CO2_emission_factor;
                this.daratgasoline.co2_emission = val.CO2_emission;
                this.daratgasoline.ch4_emission_factor = val.CH4_emission_factor;
                this.daratgasoline.ch4_emission = val.CH4_emission;
                this.daratgasoline.n2o_emission_factor = val.N2O_emission_factor;
                this.daratgasoline.n2o_co2_emission = val.N2O_CO2_emission;
                this.daratgasoline.ton_co2eq = val.ton_CO2eq;
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
            await axios.post(`/api/daratgasoline/update/${this.daratgasoline.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_daratgasoline').modal('hide');
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
                        $('#kt_edit_modal_daratgasoline').modal('hide');
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
                        // $('#kt_edit_modal_daratgasoline').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
    }
}
</script>
