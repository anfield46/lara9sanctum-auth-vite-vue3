<template>
        <!-- //line chart -->
    <div class="px-0">
            
		<div class="d-flex justify-content-between mb-3">
			<h2>Dashboard Zero Emission</h2>
			<router-link :to="{name:'faq'}" class="btn btn-sm btn-primary fw-bold wr_primary" style="display: flex;padding-top: 10px;">
                <svg width="15" height="15" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.0999 10C20.0999 15.3019 15.8018 19.6 10.4999 19.6C5.19797 19.6 0.899902 15.3019 0.899902 10C0.899902 4.69807 5.19797 0.400002 10.4999 0.400002C15.8018 0.400002 20.0999 4.69807 20.0999 10ZM10.4999 6.4C10.0573 6.4 9.66902 6.63906 9.45972 7.00087C9.12787 7.57455 8.3938 7.77058 7.82013 7.43873C7.24645 7.10688 7.05042 6.3728 7.38227 5.79913C8.00291 4.72622 9.1659 4 10.4999 4C12.4881 4 14.0999 5.61178 14.0999 7.6C14.0999 9.16747 13.0982 10.501 11.6999 10.9952V11.2C11.6999 11.8627 11.1627 12.4 10.4999 12.4C9.83718 12.4 9.29992 11.8627 9.29992 11.2V10C9.29992 9.33726 9.83718 8.8 10.4999 8.8C11.1627 8.8 11.6999 8.26274 11.6999 7.6C11.6999 6.93726 11.1627 6.4 10.4999 6.4ZM10.4999 16C11.1626 16 11.6999 15.4627 11.6999 14.8C11.6999 14.1373 11.1626 13.6 10.4999 13.6C9.83716 13.6 9.2999 14.1373 9.2999 14.8C9.2999 15.4627 9.83716 16 10.4999 16Z" fill="#F6F6F6"/>
                </svg>
                <span>&nbsp;FAQ</span>
            </router-link>
		</div>
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-body p-0">
                        <h3 class="m-7 zoomout">
                            <b class="primary_color">Proyeksi Emisi GRK PKT 2019-2060 </b>
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5.66667V9M9 12.3333H9.00833M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#4B4B50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </h3>
                        <div class="hello" ref="chartdiv"></div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow zoomout" style="height: 100%;">
                    <div class="card-body">
                        <h3 class="mb-7">
                            <b class="primary_color">Intensitas Emisi Per Produk </b> 
                            <el-tooltip
                                class="box-item"
                                effect="dark"
                                content="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                                placement="right"
                            >
                                <el-button>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5.66667V9M9 12.3333H9.00833M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#4B4B50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </el-button>
                            </el-tooltip>
                        </h3>

                        <div class="row">
                            <!--begin::Col-->
                                <div class="col-6 mb-4" v-for="data in current_intensitas_emisi" :key="data.sumber_emisi">
                                    <!--begin::Card widget 2-->
                                    <div class="card shadow-sm h-lg-80">
                                        <!--begin::Body-->
                                        <div class="d-flex justify-content-between align-items-start flex-column intensitas-bg">
                                            <!--begin::Section--> 
                                            <div class="d-flex flex-column m-6">
                                                <!--begin::Number-->           
                                                <span class="fw-semibold fs-4">{{ data.sumber_emisi }}</span>
                                                <span class="fw-semibold fs-4"><span class="fs-1">{{ parseFloat(data.total).toFixed(2) }}</span> ton CO2 eq</span>
                                                <!--end::Number-->
                                            </div>  
                                            <!--end::Section-->                         
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card widget 2-->
                                </div>
                            <!--end::Col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-2">
            <div class="row" style="padding-top: 10px;">
                <div class="col-4 zoomout d-flex" style="align-items:center;">
                    <div class="" style="width:100%;">
                        <div class="card-body p-4">
                            <h3 class="primary_color"><b>Scope Emission</b></h3>
                            <div class="hello" ref="chartpiediv"></div>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                </div>
                <div class="col-8">
                    <div class="" style="height: 100%;">
                        <div class="card-body p-4" style="height: 100%;">
                            <div class="d-flex justify-content-between">
                                <h3 class="zoomout primary_color"><b>Emission Categories</b></h3>
                                <router-link :to="{name:'faq'}" class="btn btn-sm secondary_color" style="padding: 0px;"><strong>Lihat Detail</strong></router-link>
                            </div>
                            <div class="" style="z-index:1000;" ref="chartbardiv"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.vertical-line {
  width: 1px;
  height: 80%; /* Adjust the height as needed */
  background-color: #E4E4E5; /* Change the color to your preference */
}

.card {
    border-radius: 15px;
}

.primary_color{
    color: #0F416A;
}

.secondary_color{
    color: #D36428;
}

</style>
<script>

import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);
am4core.addLicense("CH283435101");

import { ref } from 'vue';

export default {
    name:"dashboard",
    setup() {
        const showTooltip = ref(false);

        return {
            showTooltip
        };
    },
    data(){
        return {
            user:this.$store.state.auth.user,
            value_zoom: "50%",
            current_intensitas_emisi:[]
        }
    },
    created(){
        this.value_zoom = "70%";
    },
    mounted() {

        axios.get(`/api/baseline/baseline`).then(response => {
        ///startlinechart
            this.current_intensitas_emisi = response.data.current_intensitas_emisi;

            let chart = am4core.create(this.$refs.chartdiv, am4charts.XYChart);
            chart.data = response.data.chart_bau;
            chart.height = am4core.percent(100);
            chart.width = am4core.percent(95);

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "tahun";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 10;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.renderer.labels.template.fontSize = 9;
            categoryAxis.tooltip.disabled = true;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.extraMax = 0.1;
            valueAxis.extraMin = 0.1;
            valueAxis.renderer.minGridDistance = 10;
            valueAxis.tooltip.disabled = true;
            valueAxis.renderer.labels.template.fontSize = 7;

            var tooltipHTML = `<div style="zoom:50%;" >
                                    <center><strong>YEAR {categoryX}</strong></center>
                                    <table>
                                    <tr>
                                    <th align="left">BAU </th>
                                    <th>{total_bau}</th>
                                    </tr>
                                    <tr>
                                    <th align="left">Rencana Proyeksi </th>
                                    <th>{total_rencana}</th>
                                    </tr>
                                    <tr>
                                    <th align="left">Realisasi </th>
                                    <th>{total_realisasi}</th>
                                    </tr>
                                    </table>
                                    <center><input type="button" class="btn" style="padding:5px; font-size:14px;" value="click to see details" onclick="alert('You clicked on {categoryX}')" /><center>
                                <div>`;

            // Create series
            function createSeries(field, name, zindex, fill, stroke, strokewidth, fillopacity,strokedasharray) {
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = field;
                series.dataFields.categoryX = "tahun";
                series.name = name;
                series.tooltipHTML = tooltipHTML;
                series.tooltip.label.interactionsEnabled = true;
                series.tooltip.pointerOrientation = "vertical";
                series.zIndex = zindex;
                series.fill = am4core.color(fill);
                series.stroke = am4core.color(stroke);
                series.strokeWidth = strokewidth;
                series.fillOpacity = fillopacity;
                series.strokeDasharray = strokedasharray;
                series.smoothing = "monotoneX";

            // if (zindex == 1) {
            //     var fillModifier = new am4core.LinearGradientModifier();
            //     fillModifier.opacities = [0.5, 0];
            //     fillModifier.offsets = [0, 1];
            //     fillModifier.gradient.rotation = 90;
            //     series.segments.template.fillModifier = fillModifier;
            // }
            
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.stroke = am4core.color("#fff");
            bullet.circle.strokeWidth = 0.5;
            bullet.circle.fontSize = 9;
            bullet.circle.radius = 2;
            
            series.events.once("ready", function(ev) {
                chart.legend.children.moveValue(ev.target.legendDataItem.itemContainer, ev.target.zIndex);
            });

            return series;
            }

            createSeries("total_bau", "Business As Usual", 1, "#F47920", "#F47920", 1, 0, null);
            createSeries("total_rencana", "Rencana", 2, "#A8E58A", "#A8E58A", 1, 0, "5,4");
            createSeries("total_realisasi", "Realisasi", 3, "#1268B3", "#1268B3", 1, 0, null);

            chart.legend = new am4charts.Legend();
            chart.legend.fontSize = 11;
            chart.legend.position = "left";
            chart.legend.labels.template.text = "[bold {color}]{name}[/]";
            let markerTemplate = chart.legend.markers.template;
            markerTemplate.width = 40;
            markerTemplate.height = 5;
            // chart.cursor = new am4charts.XYCursor();

            /* Create a cursor */
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.maxTooltipDistance = -1;

            // Set cell size in pixels
            var cellSize = 4.2;
            chart.events.on("datavalidated", function(ev) {
            
            // Get objects of interest
            var chart = ev.target;
            var categoryAxis = chart.yAxes.getIndex(0);
            
            // Calculate how we need to adjust chart height
            var adjustHeight = (chart.data.length * cellSize) - categoryAxis.pixelHeight;

            // get current chart height
            var targetHeight = chart.pixelHeight + adjustHeight;

            // Set it on chart's container
            chart.svgContainer.htmlElement.style.height = targetHeight + "px";
            // chart.svgContainer.htmlElement.style.height = "100%";
            // chart.svgContainer.htmlElement.style.width = "100%";
            });

            // chart.svgContainer.htmlElement.style.zoom = "30%";

            chart.svgContainer.measure();

            this.chart = chart;
        ///endlinechart
            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
        ///startpiechart
            // Create chart instance
            var chartpie = am4core.create(this.$refs.chartpiediv, am4charts.PieChart);

            chartpie.data = response.data.current_scope;

            // Add and configure Series
            var pieSeries = chartpie.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "total";
            pieSeries.dataFields.category = "scope";

            // Let's cut a hole in our Pie chart the size of 30% the radius
            chartpie.innerRadius = am4core.percent(0);

            // Put a thick white border around each Slice
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;
            pieSeries.slices.template
            // change the cursor on hover to make it apparent the object can be interacted with
            .cursorOverStyle = [
                {
                "property": "cursor",
                "value": "pointer"
                }
            ];

            pieSeries.alignLabels = false;
            pieSeries.labels.template.bent = true;
            pieSeries.labels.template.radius = 3;
            pieSeries.labels.template.padding(0,0,0,0);

            pieSeries.ticks.template.disabled = true;

            // Create a base filter effect (as if it's not there) for the hover to return to
            var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
            shadow.opacity = 0;

            // Create hover state
            var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

            // Slightly shift the shadow and make it more prominent on hover
            var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
            hoverShadow.opacity = 0.7;
            hoverShadow.blur = 5;

            // Add a legend
            chartpie.legend = new am4charts.Legend();
        
            pieSeries.colors.list = [
                am4core.color("#8BC5F5"),
                am4core.color("#A8E58A"),
                am4core.color("#F5C273")
            ];

            this.chartpie = chartpie;
        ///endpiechart
            //////////////////////////////////////////
            //////////////////////////////////////////
            //////////////////////////////////////////
            //////////////////////////////////////////
        ///startbarchart
            var chartbar = am4core.create(this.$refs.chartbardiv, am4charts.XYChart);
            // Add data
            chartbar.data = response.data.current_category;
            chartbar.height = am4core.percent(100);
            chartbar.width = am4core.percent(100);

            // Create axes
            var categoryAxis = chartbar.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "category";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 5;
            categoryAxis.renderer.inversed = true;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.labels.template.fontSize = 9;

            var valueAxis = chartbar.xAxes.push(new am4charts.ValueAxis());
            // valueAxis.min = 0;
            valueAxis.renderer.labels.template.fontSize = 9;
            valueAxis.logarithmic = true;

            var tooltipHTMLbar = `<div style="zoom:50%;" >
                                    <div><strong>{category}</strong></div>
                                    <div><strong>{total}</strong></div>
                                <div>`;

            // Create series
            var series = chartbar.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = "total";
            series.dataFields.categoryY = "category";
            series.columns.template.strokeWidth = 0;
            series.columns.template.column.cornerRadiusBottomRight = 5;
            series.columns.template.column.cornerRadiusTopRight = 5;
            series.columns.template.column.fillOpacity = 0.8;
            // Set up tooltip
            series.tooltipHTML = tooltipHTMLbar;

            // categoryAxis.sortBySeries = series;

            var bullet = series.bullets.push(new am4charts.LabelBullet());
            bullet.label.text = "{values.valueX.workingValue.formatNumber('#.0as')}";
            bullet.label.truncate = false;
            bullet.label.hideOversized = false;
            bullet.label.horizontalCenter = "left";
            bullet.label.dx = 10;
            bullet.locationX = 1;
            bullet.label.fontSize = 8;

            // on hover, make corner radiuses bigger
            // var hoverState = series.columns.template.column.states.create("hover");
            // hoverState.properties.cornerRadiusTopLeft = 0;
            // hoverState.properties.cornerRadiusTopRight = 0;
            // hoverState.properties.fillOpacity = 1;

            // will use this to store colors of the same items
            // Modify chart's colors
            chartbar.colors.list = [
                am4core.color("#845EC2"),
                am4core.color("#D65DB1"),
                am4core.color("#FF6F91"),
                am4core.color("#FF9671"),
                am4core.color("#FFC75F"),
                am4core.color("#F9F871"),
            ];
            var colors = {};

            series.columns.template.adapter.add("fill", function(fill, target) {
                var name = target.dataItem.dataContext.scope;
                if (!colors[name]) {
                colors[name] = pieSeries.colors.next();
                }
                target.stroke = colors[name];
                return colors[name];
            });

            // Cursor
            chartbar.cursor = new am4charts.XYCursor();
        
            chartbar.svgContainer.htmlElement.style.height = "100%";
            chartbar.svgContainer.htmlElement.style.width = "100%";

            chartbar.svgContainer.measure();
        ///endbarchart

        })
        .catch(function (error) {
            console.error(error);
        });
                
    },
    methods: {
        fetchBaseline() {
            axios.get('/sanctum/csrf-cookie')
            axios.get(`/api/baseline/baseline`)
                .then(response => {
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    },
    beforeDestroy() {
        if (this.chart) {
            this.chart.dispose();
        }
        if (this.chartpie) {
            this.chartpie.dispose();
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.hello {
  width: 100%;
  height: 400px;
}
</style>