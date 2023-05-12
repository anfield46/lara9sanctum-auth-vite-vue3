<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="editFugitiveModalRef"
    id="kt_edit_modal_fugitive"
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
                <h2 class="fw-bold">Edit Data Fugitive</h2>
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
              id="kt_edit_modal_fugitive_scroll"
            >
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" v-model="fugitive.tahun" type="select" v-slot="{ value, field, errorMessage }">
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
                            <Field name="pabrik" v-model="fugitive.pabrik" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Pabrik" required>
                                <el-input
                                placeholder="Pabrik"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="sumber_emisi" v-model="fugitive.sumber_emisi" v-slot="{ value, field, errorMessage }">
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
                            <Field name="combustion_eficiency" v-model="fugitive.combustion_eficiency" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Combustion Eficiency" required>
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
                            <Field name="conversion_factor" v-model="fugitive.conversion_factor" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Conversion Factor" required>
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
                            <Field name="stoichiometric_mass_factor" v-model="fugitive.stoichiometric_mass_factor" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Stoichiometric Mass Factor" required>
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
                            <Field name="volume_of_methane" v-model="fugitive.volume_of_methane" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Volume Of Methane" required>
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
                            <Field name="CO2_emission_gg_year" v-model="fugitive.CO2_emission_gg_year" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Emission gg/year" required>
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
                            <Field name="CO2_emission_ton_year" v-model="fugitive.CO2_emission_ton_year" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="CO2 Emission Ton/year" required>
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
    props: ["detailfugitive"],
    data() {
        return {
            loading:false,
            value:"tes",
            fugitive: {
                id: "",
                tahun: "",
                pabrik: "",
                sumber_emisi: "",
                combustion_eficiency: "",
                conversion_factor: "",
                stoichiometric_mass_factor: "",
                volume_of_methane: "",
                CO2_emission_gg_year: "",
                CO2_emission_ton_year: "",
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
            sumber_emisi: yup.string().required().label('Sumber Emisi'),
            combustion_eficiency: yup.number().required().label('Combustion Eficiency'),
            conversion_factor: yup.number().required().label('Conversion Factor'),
            stoichiometric_mass_factor: yup.number().required().label('Stoichiometric Mass Factor'),
            volume_of_methane: yup.number().required().label('Volume Of Methane'),
            CO2_emission_gg_year: yup.number().required().label('CO2 Emission gg/year'),
            CO2_emission_ton_year: yup.number().required().label('CO2 Emission Ton/year')
            });
        return {
            schema,
        };
    },
    watch: {
        detailfugitive: {
            handler(val, old) {
                this.fugitive.id = val.id,
                this.fugitive.tahun = val.tahun,
                this.fugitive.pabrik = val.pabrik,
                this.fugitive.sumber_emisi = val.sumber_emisi,
                this.fugitive.combustion_eficiency = val.combustion_eficiency,
                this.fugitive.conversion_factor = val.conversion_factor,
                this.fugitive.stoichiometric_mass_factor = val.stoichiometric_mass_factor,
                this.fugitive.volume_of_methane = val.volume_of_methane,
                this.fugitive.CO2_emission_gg_year = val.CO2_emission_gg_year,
                this.fugitive.CO2_emission_ton_year = val.CO2_emission_ton_year
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
            await axios.post(`/api/fugitive/update/${this.fugitive.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_fugitive').modal('hide');
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
                        $('#kt_edit_modal_fugitive').modal('hide');
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
                        // $('#kt_edit_modal_fugitive').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
    }
}
</script>
