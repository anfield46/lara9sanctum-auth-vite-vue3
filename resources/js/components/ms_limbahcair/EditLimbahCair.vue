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
                            <Field name="industrial_sector" type="select" v-model="limbahcair.industrial_sector" v-slot="{ value, field, errorMessage }">
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
                        <el-col :span="10">
                            <Field name="EP_A" type="number" v-model="limbahcair.EP_A" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Wastewater generated EP-A" required>
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
                            <Field name="EP_B" type="number" v-model="limbahcair.EP_B" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Wastewater generated EP-B" required>
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
                        <el-col :span="10">
                            <Field name="Pi" type="number" v-model="limbahcair.Pi" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Total industry product" required>
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
                            <Field name="CODi" type="number" v-model="limbahcair.CODi" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Chemical Oxygen Demand" required>
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
                EP_A: "",
                EP_B: "",
                Pi: "",
                CODi: ""
            },
            tahun_options: [],
        }
    },
    setup() {
        const schema = yup.object({
            industrial_sector: yup.string().required().label('Industrial sector'),
            EP_A: yup.number().required().label('Wastewater generated EP-A'),
            EP_B: yup.number().required().label('Wastewater generated EP-B'),
            Pi: yup.number().required().label('Total industry product'),
            CODi: yup.number().required().label('Chemical Oxygen Demand'),
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
                this.limbahcair.EP_A = val.EP_A,
                this.limbahcair.EP_B = val.EP_B,
                this.limbahcair.Pi = val.Pi,
                this.limbahcair.CODi = val.CODi
            },
        },
    },
    created() {
        this.fetchTahun();
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
        fetchTahun() {
            axios.get(`/api/valuelist/gettahundata`)
                .then(response => {
                    this.tahun_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    }
}
</script>
