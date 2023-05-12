<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="editLimbahCairModalRef"
    id="kt_edit_modal_limbahcair"
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
                <h2 class="fw-bold">Edit Data Limbah Cair</h2>
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
              id="kt_edit_modal_limbahcair_scroll"
            >
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="industrial_sector" v-model="limbahcair.industrial_sector" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Industrial sector" required>
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
                            <Field name="type_of_treatment_or_discharge_pathway" v-model="limbahcair.type_of_treatment_or_discharge_pathway" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Type of treatment or discharge pathway" required>
                                <el-input
                                placeholder="Type of treatment or discharge pathway"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>

                        <el-col :span="12">
                            <Field name="TOWi" v-model="limbahcair.TOWi" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Total organic degradable material in wastewater for each industry sector" required>
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
                            <Field name="Si" type="number" v-model="limbahcair.Si" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Sludge removed in each industry sector" required>
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
                            <Field name="EFi" type="number" v-model="limbahcair.EFi" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Emission factor for each treatment system" required>
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
                            <Field name="Ri" type="number" v-model="limbahcair.Ri" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Recovered CH4 in each industry sector" required>
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
                            <Field name="CH4" v-model="limbahcair.CH4" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Net methane emissions" required>
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
                            <Field name="CO2eq" v-model="limbahcair.CO2eq" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 equivalent" required>
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
    props: ["detaillimbahcair"],
    data() {
        return {
            loading:false,
            value:"tes",
            limbahcair: {
                id: "",
                industrial_sector: "",
                type_of_treatment_or_discharge_pathway: "",
                TOWi: "",
                Si: "",
                EFi: "",
                Ri: "",
                CH4: "",
                CO2eq: ""
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
            industrial_sector: yup.string().required().label('Industrial sector'),
            type_of_treatment_or_discharge_pathway: yup.string().required().label('Type of treatment or discharge pathway'),
            TOWi: yup.number().required().label('Total organic degradable material in wastewater for each industry sector'),
            Si: yup.number().required().label('Sludge removed in each industry sector'),
            EFi: yup.number().required().label('Emission factor for each treatment system'),
            Ri: yup.number().required().label('Recovered CH4 in each industry sector'),
            CH4: yup.number().required().label('Net methane emissions'),
            CO2eq: yup.number().required().label('CO2 equivalent')
            });
        return {
            schema,
        };
    },
    watch: {
        detaillimbahcair: {
            handler(val, old) {
                this.limbahcair.id = val.id;
                this.limbahcair.industrial_sector = val.industrial_sector,
                this.limbahcair.type_of_treatment_or_discharge_pathway = val.type_of_treatment_or_discharge_pathway,
                this.limbahcair.TOWi = val.TOWi,
                this.limbahcair.Si = val.Si,
                this.limbahcair.EFi = val.EFi,
                this.limbahcair.Ri = val.Ri,
                this.limbahcair.CH4 = val.CH4,
                this.limbahcair.CO2eq =val.CO2eq 
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
            await axios.post(`/api/limbahcair/update/${this.limbahcair.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_limbahcair').modal('hide');
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
                        $('#kt_edit_modal_limbahcair').modal('hide');
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
                        // $('#kt_edit_modal_limbahcair').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
    }
}
</script>
