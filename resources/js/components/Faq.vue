<template>
        <div class="mx-4">
            <div class="d-flex justify-content-between">
                <router-link :to="{name:'dashboard'}" class="btn btn-sm" style="display: flex;align-items: center;">
                    <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 16L2 9L9 2" stroke="#1E1E24" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <h3 style="margin: 0px;">&nbsp; FAQ</h3>
                </router-link>
            </div>
            <div class="accordion" id="myAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne"><h4>PT Pupuk Kaltim Greenhouse Gas Emission Sources based on Scope</h4></button>					
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#myAccordion">
                        <div class="card-body">
                            <div class="m-4">
                                <h4 style="display: flex;align-items: end;"><span class="symbol-badge badge badge-circle bg-primary">&nbsp;</span>&nbsp; Scope 1</h4>
                                <div class="my-4 mx-5">
                                    <p>Greenhouse Gas Emissions from sources directly owned and controlled by the company.</p>
                                    <div class="d-flex flex-wrap" style="justify-content: space-between;">
                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Factory_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">&nbsp; Emission factory 2, 3, 4, 5, 6, 7, and 1A</div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Emergency_pond_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Emergency Pond A & B
                                            </div>
                                        </div>
                                    
                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Flare_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Flare
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Refrigerant_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Refrigerant
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Vehicle_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Ground Transportation
                                            </div>
                                        </div>
                                    
                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Housing_facilities_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Housing & Facilities
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4 style="display: flex;align-items: end;"><span class="symbol-badge badge badge-circle bg-success">&nbsp;</span>&nbsp; Scope 2</h4>
                                <div class="my-4 mx-5">
                                    <p>Greenhouse Gas emissions from indirect sources such as purchases of electricity, steam or heat.</p>
                                    <div class="d-flex flex-wrap" style="justify-content: space-between;">
                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Impor_listrik_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Import of electricity and steam from third parties (KDM) for the production process
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4 style="display: flex;align-items: end;"><span class="symbol-badge badge badge-circle bg-warning">&nbsp;</span>&nbsp; Scope 3</h4>
                                <div class="my-3 mx-5">
                                    <p>Greenhouse Gas Emissions from indirect sources and not directly controlled by the company but related to the company's upstream or downstream activities.</p>
                                    <div class="d-flex flex-wrap" style="justify-content: space-between;">
                                        <div class="d-flex">    
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Plane_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Airplane PKT (Avtur)
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Warehouse_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Werehouse
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Kapal_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Distribution - Ocean/Ship
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Pakai_pupuk_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Farmers use of NPK and Urea fertilizers
                                            </div>
                                        </div>
                                            
                                        <div class="d-flex">
                                            <div class="symbol symbol-50px">
                                                <div class="symbol-label" style="background-image:url('assets/media/icons/pkt/scope/Sampah_2.svg')"></div>
                                            </div>
                                            <div class="d-flex" style="align-items: center;">
                                                &nbsp; Domestic waste emission
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo"><h4>Question 2 (for future needs)</h4></button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                        <div class="card-body">
                            <div class="m-4">
                                Question 2 (for future needs)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree"><h4>Question 3 (for future needs)</h4></button>                     
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                        <div class="card-body">
                            <div class="m-4">
                                Question 3 (for future needs)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<style>
    .accordion-item{
        background-color: white !important;
    }

</style>

<script>
import { mapActions } from 'vuex'
import "bootstrap"
export default {
    name:'register',
    data(){
        return {
            processing:false
        }
    },
    methods:{
    }
}
</script>