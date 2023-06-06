<template>
        <!-- //line chart -->
        <!-- <div class="row" :style="{ 'zoom': value_zoom }"> -->
        <div class="row ">
            <div class="col-8">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <h3 class="m-7 zoomout"><b>Proyeksi Emisi GRK PKT 2019-2060</b></h3>
                        <div class="hello" ref="chartdiv"></div>
                    </div>
                </div>
            </div>
            <div class="col-4 zoomout">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="mb-7"><b>Intensitas Emisi Per Produk</b></h3>

                        <div class="row">
                            <!--begin::Col-->
                                <div class="col-6" v-for="data in current_intensitas_emisi" :key="data.sumber_emisi">
                                    <!--begin::Card widget 2-->
                                    <div class="card h-lg-80 mb-3">
                                        <!--begin::Body-->
                                        <div class="d-flex justify-content-between align-items-start flex-column intensitas-bg">
                                            <!--begin::Section--> 
                                            <div class="d-flex flex-column m-6">
                                                <!--begin::Number-->           
                                                <span class="fw-semibold fs-3">{{ parseFloat(data.total).toFixed(2) }} ton CO2 eq</span>
                                                <span class="fw-semibold">{{ data.sumber_emisi }}</span>
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

        <div class="row" style="padding-top: 10px;">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body p-4" style="height: 400px;">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="zoomout"><b>Emission Categories</b></h3>
                                <div class="hello" ref="chartbardiv"></div>
                            </div>
                            <div class="col-4 zoomout">
                                <h3 class=""><b>Scope Emission</b></h3>
                                <div class="hello" ref="chartpiediv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>

import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

export default {
    name:"dashboard",
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
            chart.height = am4core.percent(95);
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

            var tooltipHTML = `<div style="zoom:50%;" ><center><strong>YEAR {categoryX}</strong></center>
                                <hr />
                                <table>
                                <tr>
                                <th align="left">BAU</th>
                                <td>{total_bau}</td>
                                </tr>
                                <tr>
                                <th align="left">Rencana Proyeksi</th>
                                <td>{total_rencana}</td>
                                </tr>
                                <tr>
                                <th align="left">Realisasi</th>
                                <td>{total_realisasi}</td>
                                </tr>
                                </table>
                                <hr />
                                <center><input type="button" value="More info" onclick="alert('You clicked on {categoryX}')" /></center><div>`;

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

            if (zindex == 1) {
                var fillModifier = new am4core.LinearGradientModifier();
                fillModifier.opacities = [0.5, 0];
                fillModifier.offsets = [0, 1];
                fillModifier.gradient.rotation = 90;
                series.segments.template.fillModifier = fillModifier;
            }
            
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

            createSeries("total_bau", "Business As Usual", 1, "#1268B3", "#1268B3", 1, 0.5, null);
            createSeries("total_rencana", "Rencana", 2, "#53D6BE", "#53D6BE", 0.5, 0, "5,4");
            createSeries("total_realisasi", "Realisasi", 3, "#F47920", "#F47920", 0.5, 0, null);

            chart.legend = new am4charts.Legend();
            chart.legend.fontSize = 9;
            chart.legend.position = "right";
            // chart.cursor = new am4charts.XYCursor();

            /* Create a cursor */
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.maxTooltipDistance = -1;

            // Set cell size in pixels
            var cellSize = 3.5;
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
            chartpie.innerRadius = am4core.percent(30);

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
            chartbar.height = am4core.percent(90);
            chartbar.width = am4core.percent(70);

            // Create axes
            var categoryAxis = chartbar.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "category";
            categoryAxis.renderer.grid.template.location = 1;
            categoryAxis.renderer.minGridDistance = 5;
            categoryAxis.renderer.labels.template.horizontalCenter = "left";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = -90;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.labels.template.disabled = true;
            categoryAxis.renderer.labels.template.fontSize = 9;


            var valueAxis = chartbar.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minWidth = 50;
            valueAxis.renderer.minGridDistance = 12;
            valueAxis.renderer.labels.template.fontSize = 9;

            // Create series
            var series = chartbar.series.push(new am4charts.ColumnSeries());
            series.sequencedInterpolation = true;
            series.dataFields.valueY = "total";
            series.dataFields.categoryX = "category";
            series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
            series.columns.template.strokeWidth = 0;

            series.tooltip.pointerOrientation = "vertical";

            series.columns.template.column.cornerRadiusTopLeft = 10;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.fillOpacity = 0.8;

            pieSeries.colors.list = [
                am4core.color("#8BC5F5"),
                am4core.color("#A8E58A"),
                am4core.color("#F5C273")
            ];

            var bullet = series.bullets.push(new am4charts.LabelBullet());
            bullet.label.text = "{category}";
            bullet.rotation = -90;
            bullet.label.truncate = false;
            bullet.label.hideOversized = false;
            bullet.label.horizontalCenter = "left";
            bullet.label.dx = 10;
            bullet.locationY = 1;
            bullet.label.fontSize = 8;

            // on hover, make corner radiuses bigger
            var hoverState = series.columns.template.column.states.create("hover");
            hoverState.properties.cornerRadiusTopLeft = 0;
            hoverState.properties.cornerRadiusTopRight = 0;
            hoverState.properties.fillOpacity = 1;

            series.columns.template.adapter.add("fill", function(fill, target) {
            return chartbar.colors.getIndex(target.dataItem.index);
            });

            // Cursor
            chartbar.cursor = new am4charts.XYCursor();

            chartbar.legend = new am4charts.Legend();
            chartbar.legend.fontSize = 9;
            chartbar.legend.position = "right";
        
            chartbar.svgContainer.htmlElement.style.height = "90%";

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
  height: 500px;
}
</style>