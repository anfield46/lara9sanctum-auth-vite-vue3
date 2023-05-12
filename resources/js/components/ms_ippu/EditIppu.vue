<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="editIppuModalRef"
    id="kt_edit_modal_ippu"
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
                <h2 class="fw-bold">Edit Data Ippu</h2>
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
              id="kt_edit_modal_ippu_scroll"
            >
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" v-model="ippu.tahun" type="select" v-slot="{ value, field, errorMessage }">
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
                            <Field name="sumber_emisi" v-model="ippu.sumber_emisi" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Sumber Emisi" required>
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
                        <el-col :span="12">
                            <Field name="amount_of_ammonia_produced" v-model="ippu.amount_of_ammonia_produced" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Amount of Ammonia Produced" required>
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
                            <Field name="fuel_requirement_for_ammonia_production" v-model="ippu.fuel_requirement_for_ammonia_production" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Fuel Requirement for Ammonia Production" required>
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
                            <Field name="carbon_content_of_fuel" v-model="ippu.carbon_content_of_fuel" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Carbon Content of Fuel" required>
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
                            <Field name="carbon_oxidation_factor_of_fuel" v-model="ippu.carbon_oxidation_factor_of_fuel" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Carbon Oxidation Factor of Fuel" required>
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
                            <Field name="CO2_generated" v-model="ippu.CO2_generated" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Generated" required>
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
                            <Field name="amount_of_urea_produced" v-model="ippu.amount_of_urea_produced" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Amount of Urea Produced" required>
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
                            <Field name="CO2_recovered_for_urea_production" v-model="ippu.CO2_recovered_for_urea_production" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Recovered for Urea Production" required>
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
                            <Field name="CO2_recovered_for_urea" v-model="ippu.CO2_recovered_for_urea" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Recovered for Urea" required>
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
                            <Field name="CO2_emissions" v-model="ippu.CO2_emissions" type="number" v-slot="{ value, field, errorMessage }">
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
    props: ["detailippu"],
    data() {
        return {
            loading:false,
            value:"tes",
            ippu: {
                id: "",
                tahun : "",
                sumber_emisi : "",
                amount_of_ammonia_produced : "",
                fuel_requirement_for_ammonia_production : "",
                carbon_content_of_fuel : "",
                carbon_oxidation_factor_of_fuel : "",
                CO2_generated : "",
                amount_of_urea_produced : "",
                CO2_recovered_for_urea_production : "",
                CO2_recovered_for_urea : "",
                CO2_emissions : "",
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
            sumber_emisi: yup.string().required().label('Sumber Emisi'),
            amount_of_ammonia_produced: yup.number().required().label('Amount of Ammonia Produced'),
            fuel_requirement_for_ammonia_production: yup.number().required().label('Fuel Requirement for Ammonia Production'),
            carbon_content_of_fuel: yup.number().required().label('Carbon Content of Fuel'),
            carbon_oxidation_factor_of_fuel: yup.number().required().label('Carbon Oxidation Factor of Fuel'),
            CO2_generated: yup.number().required().label('CO2 Generated'),
            amount_of_urea_produced: yup.number().required().label('Amount of Urea Produced'),
            CO2_recovered_for_urea_production: yup.number().required().label('CO2 Recovered for Urea Production'),
            CO2_recovered_for_urea: yup.number().required().label('CO2 Recovered for Urea'),
            CO2_emissions: yup.number().required().label('CO2 Emissions')
            });
        return {
            schema,
        };
    },
    watch: {
        detailippu: {
            handler(val, old) {
                this.ippu.id = val.id;
                this.ippu.tahun = val.tahun;
                this.ippu.sumber_emisi = val.sumber_emisi;
                this.ippu.amount_of_ammonia_produced = val.amount_of_ammonia_produced;
                this.ippu.fuel_requirement_for_ammonia_production = val.fuel_requirement_for_ammonia_production;
                this.ippu.carbon_content_of_fuel = val.carbon_content_of_fuel;
                this.ippu.carbon_oxidation_factor_of_fuel = val.carbon_oxidation_factor_of_fuel;
                this.ippu.CO2_generated = val.CO2_generated;
                this.ippu.amount_of_urea_produced = val.amount_of_urea_produced;
                this.ippu.CO2_recovered_for_urea_production = val.CO2_recovered_for_urea_production;
                this.ippu.CO2_recovered_for_urea = val.CO2_recovered_for_urea;
                this.ippu.CO2_emissions = val.CO2_emissions;
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
            await axios.post(`/api/ippu/update/${this.ippu.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_ippu').modal('hide');
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
                        $('#kt_edit_modal_ippu').modal('hide');
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
                        // $('#kt_edit_modal_ippu').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
    }
}
</script>
