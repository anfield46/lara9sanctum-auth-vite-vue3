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
                            <Field name="tahun" type="select" v-model="ippu.tahun" v-slot="{ value, field, errorMessage }">
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
                            <Field name="id_pabrik" type="select" v-model="ippu.id_pabrik" v-slot="{ value, field, errorMessage }">
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
                            <Field name="gas_fuel_needs" v-model="ippu.gas_fuel_needs" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Kebutuhan Gas Fuel" required>
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
                            <Field name="gas_process_needs" v-model="ippu.gas_process_needs" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Kebutuhan Gas Proses" required>
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
                id_pabrik : 0,
                gas_fuel_needs : "",
                gas_process_needs : "",
                amount_of_ammonia_produced : "",
                carbon_content_of_fuel : "",
                carbon_oxidation_factor_of_fuel : "",
                amount_of_urea_produced : "",
                CO2_recovered_for_urea : ""
            },
            tahun_options: [],
            pabrik_options: [],
        }
    },
    setup() {
        const schema = yup.object({
            tahun: yup.string().required().label('Tahun'),
            id_pabrik: yup.string().required().label('Pabrik'),
            gas_fuel_needs: yup.number().required().label('Kebutuhan Gas Fuel'),
            gas_process_needs: yup.number().required().label('Kebutuhan Gas Proses'),
            amount_of_ammonia_produced: yup.number().required().label('Amount of Ammonia Produced'),
            carbon_content_of_fuel: yup.number().required().label('Carbon Content of Fuel'),
            carbon_oxidation_factor_of_fuel: yup.number().required().label('Carbon Oxidation Factor of Fuel'),
            amount_of_urea_produced: yup.number().required().label('Amount of Urea Produced'),
            CO2_recovered_for_urea: yup.number().required().label('CO2 Recovered for Urea'),
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
                this.ippu.id_pabrik = val.id_pabrik;
                this.ippu.gas_fuel_needs = val.gas_fuel_needs;
                this.ippu.gas_process_needs = val.gas_process_needs;
                this.ippu.amount_of_ammonia_produced = val.amount_of_ammonia_produced;
                this.ippu.carbon_content_of_fuel = val.carbon_content_of_fuel;
                this.ippu.carbon_oxidation_factor_of_fuel = val.carbon_oxidation_factor_of_fuel;
                this.ippu.amount_of_urea_produced = val.amount_of_urea_produced;
                this.ippu.CO2_recovered_for_urea = val.CO2_recovered_for_urea;
            },
        },
    },
    created() {
        this.fetchTahun();
        this.fetchPabrik();
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
    }
}
</script>
