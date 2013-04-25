/*
 *
 * Wijmo Library 3.20131.2
 * http://wijmo.com/
 *
 * Copyright(c) GrapeCity, Inc.  All rights reserved.
 * 
 * Licensed under the Wijmo Commercial License. Also available under the GNU GPL Version 3 license.
 * licensing@wijmo.com
 * http://wijmo.com/widgets/license/
 *
 *
 */
var __extends = this.__extends || function (d, b) {
    function __() { this.constructor = d; }
    __.prototype = b.prototype;
    d.prototype = new __();
};
/// <reference path="../wijchart/jquery.wijmo.wijchartcore.ts"/>
/*globals jQuery, Globalize*/
/*
* Depends:
*  raphael.js
*  globalize.js
*  jquery.ui.widget.js
*  jquery.wijmo.wijchartcore.js
*
*/
var wijmo;
(function (wijmo) {
    var WijBarChart = (function (_super) {
        __extends(WijBarChart, _super);
        function WijBarChart() {
            _super.apply(this, arguments);

        }
        WijBarChart.prototype._create = function () {
            var self = this, o = self.options, defFill = self._getDefFill(), compass;
            //			if (o.horizontal) {
            //				$.extend(true, o.axis, {
            //					x: {
            //						compass: "west"
            //					},
            //					y: {
            //						compass: "south"
            //					}
            //				});
            //			}
            if(o.horizontal) {
                compass = o.axis.y.compass || "south";
                o.axis.y.compass = o.axis.x.compass || "west";
                o.axis.x.compass = compass;
            }
            $.extend(true, {
                compass: "east"
            }, o.hint);
            self._handleChartStyles();
            defFill = null;
            _super.prototype._create.call(this);
            self.chartElement.addClass(o.wijCSS.barChart);
        };
        WijBarChart.prototype._setOption = function (key, value) {
            if(key === "horizontal") {
                $.extend(true, this.options.axis, {
                    x: {
                        compass: value ? "west" : "south"
                    },
                    y: {
                        compass: value ? "south" : "west"
                    }
                });
            }
            _super.prototype._setOption.call(this, key, value);
        };
        WijBarChart.prototype.destroy = function () {
            /// <summary>
            /// Remove the functionality completely. This will return the
            /// element back to its pre-init state.
            /// Code example:
            /// $("#barchart").wijbarchart("destroy");
            /// </summary>
                        var self = this, o = self.options, element = self.chartElement, fields = element.data("fields"), aniBarsAttr = fields && fields.bars;
            element.removeClass(o.wijCSS.barChart);
            _super.prototype.destroy.call(this);
            if(aniBarsAttr && aniBarsAttr.length) {
                $.each(aniBarsAttr, function (idx, barAttr) {
                    barAttr = null;
                });
            }
            element.data("fields", null);
        };
        WijBarChart.prototype._clearChartElement = function () {
            var self = this, o = self.options, fields = self.chartElement.data("fields");
            _super.prototype._clearChartElement.call(this);
            self.element.removeData("plotInfos");
            if(!o.seriesTransition.enabled) {
                if(fields && fields.aniBarsAttr) {
                    fields.aniBarsAttr = null;
                }
            }
        };
        WijBarChart.prototype._isBarChart = function () {
            return true;
        };
        WijBarChart.prototype.getBar = /*****************************
        Widget specific implementation
        ******************************/
        /** public methods */
        function (index) {
            /// <summary>
            /// This method returns the bar, which has a set of Raphaël objects (rects)
            /// that represent bars for the series data, from the specified index.
            /// Code example:
            /// $("#barchart").wijbarchart("getBar", 2);
            /// </summary>
            /// <param name="index" type="Number">
            /// The zero-based index of the bar to return.
            /// </param>
            /// <returns type="Raphael element">
            ///  Bar object.
            /// </returns>
                        var element = this.chartElement, fields = element.data("fields");
            return fields.chartElements.bars[index];
        };
        WijBarChart.prototype._paintTooltip = /** end of public methods */
        function () {
            var self = this, element = self.chartElement, fields = element.data("fields");
            _super.prototype._paintTooltip.call(this);
            if(self.tooltip) {
                if(fields && fields.trackers && fields.trackers.length) {
                    self.tooltip.setTargets(fields.trackers);
                    self.tooltip.setOptions({
                        relatedElement: fields.trackers[0]
                    });
                }
            }
        };
        WijBarChart.prototype._getTooltipText = function (fmt, target) {
            var tar = $(target.node), dataObj, obj;
            //value = dataObj.data,
            if(tar.data("owner")) {
                tar = tar.data("owner");
            }
            dataObj = tar.data("wijchartDataObj");
            obj = {
                data: dataObj,
                value: dataObj.value,
                label: dataObj.label,
                total: dataObj.total,
                target: target,
                fmt: fmt,
                x: dataObj.x,
                y: dataObj.y
            };
            return $.proxy(fmt, obj)();
        };
        WijBarChart.prototype._preHandleSeriesData = function () {
            _super.prototype._preHandleSeriesData.call(this);
            var self = this, o = self.options, seriesList = o.seriesList;
            $.each(seriesList, function (i, n) {
                var data = n.data;
                if(data.y) {
                    $.each(data.y, function (j, y) {
                        try  {
                            if(!self._isDate(y)) {
                                data.y[j] = parseFloat(y);
                            }
                        } catch (e) {
                            data.y[j] = 1;
                        }
                    });
                }
            });
        };
        WijBarChart.prototype._paintPlotArea = function () {
            var self = this, o = self.options;
            this.barchartRender = new BarChartRender(this.chartElement, {
                canvas: self.canvas,
                bounds: self.canvasBounds,
                tooltip: self.tooltip,
                widgetName: self.widgetName,
                horizontal: o.horizontal,
                stacked: o.stacked,
                axis: o.axis,
                seriesList: o.seriesList,
                seriesStyles: o.seriesStyles,
                seriesHoverStyles: o.seriesHoverStyles,
                seriesTransition: o.seriesTransition,
                showChartLabels: o.showChartLabels,
                textStyle: o.textStyle,
                chartLabelStyle: o.chartLabelStyle,
                chartLabelFormatString: o.chartLabelFormatString,
                shadow: o.shadow,
                disabled: o.disabled,
                clusterOverlap: o.clusterOverlap,
                clusterWidth: o.clusterWidth,
                clusterSpacing: o.clusterSpacing,
                is100Percent: o.is100Percent,
                clusterRadius: o.clusterRadius,
                animation: o.animation,
                culture: self._getCulture(),
                isYTime: self.axisInfo.y[0].isTime,
                isXTime: self.axisInfo.x.isTime,
                mouseDown: $.proxy(self._mouseDown, self),
                mouseUp: $.proxy(self._mouseUp, self),
                mouseOver: $.proxy(self._mouseOver, self),
                mouseOut: $.proxy(self._mouseOut, self),
                mouseMove: $.proxy(self._mouseMove, self),
                click: $.proxy(self._click, self),
                wijCSS: o.wijCSS,
                widget: this
            });
            this.barchartRender.render();
        };
        WijBarChart.prototype._showSerieEles = function (seriesEle) {
            $.each(seriesEle, function (i, bar) {
                if(bar && bar.bar) {
                    bar.bar.show();
                    if(bar.bar.shadow) {
                        bar.bar.shadow.show();
                    }
                    if(bar.bar.tracker) {
                        bar.bar.tracker.show();
                    }
                    if($(bar.bar.node).data("wijchartDataObj")) {
                        $(bar.bar.node).data("wijchartDataObj").visible = true;
                    }
                }
                if(bar && bar.dcl) {
                    bar.dcl.show();
                }
                if(bar && bar.animatedBar && !bar.animatedBar.removed) {
                    bar.animatedBar.show();
                }
            });
        };
        WijBarChart.prototype._hideSerieEles = function (seriesEle) {
            $.each(seriesEle, function (i, bar) {
                if(bar && bar.bar) {
                    bar.bar.hide();
                    if(bar.bar.shadow) {
                        bar.bar.shadow.hide();
                    }
                    if(bar.bar.tracker) {
                        bar.bar.tracker.hide();
                    }
                    if($(bar.bar.node).data("wijchartDataObj")) {
                        $(bar.bar.node).data("wijchartDataObj").visible = false;
                    }
                }
                if(bar && bar.dcl) {
                    bar.dcl.hide();
                }
                if(bar && bar.animatedBar && !bar.animatedBar.removed) {
                    bar.animatedBar.hide();
                }
            });
        };
        WijBarChart.prototype._indicatorLineShowing = function (objs) {
            _super.prototype._indicatorLineShowing.call(this, objs);
            $.each(objs, function (i, obj) {
                if(obj.bar) {
                    obj.bar.attr(obj.hoverStyle);
                }
            });
        };
        WijBarChart.prototype._removeIndicatorStyles = function (objs) {
            $.each(objs, function (i, obj) {
                if(obj.bar) {
                    obj.bar.attr(obj.style);
                }
            });
        };
        WijBarChart.prototype._supportStacked = function () {
            return true;
        };
        WijBarChart.prototype._calculateParameters = function (axisInfo, options) {
            _super.prototype._calculateParameters.call(this, axisInfo, options);
            // check for bar chart and x axis expansion
            if(axisInfo.id === "x") {
                var minor = options.unitMinor, adj = //autoMin = options.autoMin,
                //autoMax = options.autoMax,
                this._getBarAdjustment(axisInfo);
                if(adj === 0) {
                    adj = minor;
                } else {
                    if(minor < adj && minor !== 0) {
                        adj = Math.floor(adj / minor) * minor;
                    }
                }
                /*if (autoMin) {
                axisInfo.min -= adj;
                }
                
                if (autoMax) {
                axisInfo.max += adj;
                }*/
                axisInfo.min -= adj;
                axisInfo.max += adj;
                this._calculateMajorMinor(options, axisInfo);
            }
        };
        WijBarChart.prototype._getBarAdjustment = function (axisInfo) {
            var len = 0, o = this.options, max = axisInfo.max, min = axisInfo.min, seriesList = o.seriesList, i = 0, xLen = 0;
            for(i = 0; i < seriesList.length && seriesList[i].data.x; i++) {
                xLen = seriesList[i].data.x.length;
                if(len < xLen) {
                    len = xLen;
                }
            }
            if(len > 1) {
                return (max - min) / len * o.clusterWidth * 0.0125;
            } else if(len === 1) {
                if(min === 0.0 && max === 1.0) {
                    min = -1.0;
                    axisInfo.min = min;
                }
                return (max - min) * 0.0125;
            } else {
                return 0;
            }
        };
        return WijBarChart;
    })(wijmo.WijChartCore);
    wijmo.WijBarChart = WijBarChart;    
    WijBarChart.prototype.options = $.extend(true, {
    }, wijmo.WijChartCore.prototype.options, {
        initSelector: /// <summary>
        /// Selector option for auto self initialization.
        ///	This option is internal.
        /// </summary>
        ":jqmData(role='wijbarchart')",
        wijCSS: {
            barChart: "wijmo-wijbarchart",
            barLabel: "wijbarchart-label",
            barElement: "wijbarchart",
            barTracker: "bartracker"
        },
        horizontal: /// <summary>
        /// A value that determines whether the bar chart renders horizontally or vertically.
        /// If set to false, the numeric Y axis renders to the left, and the X axis
        /// labels render below the bars.
        /// Default: true.
        /// Type: Boolean.
        /// Code example:
        ///  $("#wijbarchart").wijbarchart({
        ///		horizontal: false,
        ///		seriesList: [{
        ///			legendEntry: false,
        ///			data: {
        ///				x: ['Ford', 'GM', 'Chrysler', 'Toyota', 'Nissan', 'Honda'],
        ///				y: [.05, .04, .21, .27, .1, .24]
        ///			}
        ///		}]
        ///	});
        /// </summary>
        true,
        stacked: /// <summary>
        /// Sets a value that determines whether to stack bars in the chart to show how
        /// each value in a series contributes to the total.If you want each bar to fill
        /// up 100 percet of the chart area, you can also set the is100Percent option to true.
        /// See Clustering Data for more information on the concept of using the same X values
        /// with multiple Y series.
        /// Default: false.
        /// Type: Boolean.
        /// Code example:
        ///  $("#wijbarchart").wijbarchart({
        ///		stacked: true,
        ///		seriesList: [{
        ///			label: "US",
        ///			data: { x: ['PS3', 'XBOX360', 'Wii'], y: [12.35, 21.50, 30.56] }
        ///		}, {
        ///			label: "Japan",
        ///			data: { x: ['PS3', 'XBOX360', 'Wii'], y: [4.58, 1.23, 9.67] }
        ///		}, {
        ///			label: "Other",
        ///			data: { x: ['PS3', 'XBOX360', 'Wii'], y: [31.59, 37.14, 65.32] }
        ///		}]
        ///	});
        /// </summary>
        false,
        is100Percent: /// <summary>
        /// Sets a value that determines whether to present stacked bars as a total value
        /// of 100 percent, illustrating how each value contributes to the total.
        /// See Clustering Data for more information on the concept of using the same X
        /// values with multiple Y series.
        /// Note: This value has no effect if you do not set the stacked option to true.
        /// Default: false.
        /// Type: Boolean.
        /// Code example:
        /// $("#wijbarchart").wijbarchart({
        ///		stacked: true,
        ///		is100Percent: true,
        ///		seriesList: [{
        ///			label: "US",
        ///			legendEntry: true,
        ///			data: { x: ['PS3', 'XBOX360', 'Wii'], y: [12.35, 21.50, 30.56] }
        ///		}, {
        ///			label: "Japan",
        ///			legendEntry: true,
        ///			data: { x: ['PS3', 'XBOX360', 'Wii'], y: [4.58, 1.23, 9.67] }
        ///		}, {
        ///			label: "Other",
        ///			legendEntry: true,
        ///			data: { x: ['PS3', 'XBOX360', 'Wii'], y: [31.59, 37.14, 65.32] }
        ///		}],
        ///	});
        /// </summary>
        false,
        clusterOverlap: /// <summary>
        /// Sets the amount of each bar to render over the edge of the next bar in the same cluster,
        /// as a percentage of the bar width.
        /// Note: A cluster occurs when you have two or more series in your seriesList that have the same x data,
        /// but have different y data and different labels
        /// Default: 0.
        /// Type: Number.
        /// Code example:
        /// $("#wijbarchart").wijbarchart({
        ///	clusterOverlap: 50,
        ///	seriesList: [{
        ///		label: "2012 Auto Sales",
        ///		legendEntry: true,
        ///		data: { x: ['Ford', 'GM', 'Chrysler', 'Toyota', 'Nissan', 'Honda'], y: [.05, .04, .21, .27, .1, .24] }
        ///	},
        ///   {
        ///   	label: "2011 Auto Sales",
        ///   	legendEntry: true,
        ///   	data: { x: ['Ford', 'GM', 'Chrysler', 'Toyota', 'Nissan', 'Honda'], y: [.17, .19, .12, -.06, .17, -.07] }
        ///   }],
        /// });
        /// </summary>
        0,
        clusterWidth: /// <summary>
        /// Sets the percentage of each cluster's allocated plot area that the bars in each
        /// cluster occupy.By default, the bars occupy 85% of the cluster's plot area,
        /// leaving a small gap between clusters. A setting of 100% removes the gap,
        /// or you can make the gap more dramatic with a setting of 50%.
        /// This setting may affect your clusterSpacing option setting.
        /// Default: 85.
        /// Type: Number.
        /// Code example:
        ///  $("#wijbarchart").wijbarchart({
        ///	clusterWidth: 50,
        ///	data: { x: ['Ford', 'GM', 'Chrysler', 'Toyota', 'Nissan', 'Honda'] },
        ///	seriesList: [{
        ///		label: "2012 Auto Sales",
        ///		legendEntry: true,
        ///		data: { y: [.05, .04, .21, .27, .1, .24] }
        ///	},
        ///   {
        ///   	label: "2011 Auto Sales",
        ///   	legendEntry: true,
        ///   	data: { y: [.17, .19, .12, -.06, .17, -.07] }
        ///   }],
        /// });
        /// </summary>
        85,
        clusterRadius: /// <summary>
        /// Sets the number of pixels by which to round the corner-radius for the bars in the chart.
        /// The amount of rounding this produces depends on the size of the bar.For example,
        /// with a clusterRadius of 3, a small bar might look like a ball on the end,
        /// while a very large bar might only show a slight rounding of the corners.
        /// Default: 0.
        /// Type: Number.
        /// Code example:
        ///  $("#barchart").wijbarchart({
        ///      clusterRadius: 5
        ///  });
        /// </summary>
        0,
        clusterSpacing: /// <summary>
        /// Sets the amount of space in pixels between the bars in each cluster.
        /// This space may also be affected by the clusterOverlap and clusterWidth option settings.
        /// Default: 0.
        /// Type: Number.
        /// Code example:
        ///  $("#barchart").wijbarchart({
        ///      clusterSpacing: 3
        ///  });
        /// </summary>
        0,
        animation: /// <summary>
        /// The animation option determines whether or not the animation is shown.
        /// If true, it defines the animation effect and controls other aspects of the
        /// widget's animation, such as duration and easing.
        /// Set this option to false in order to disable the animation effect.
        /// Default: {enabled:true, duration:400, easing: ">"}.
        /// Type: Object.
        /// Code example:
        ///  $("#barchart").wijbarchart({
        ///      animation: {
        ///			enabled: true, duration: 1000, easing: "<"
        ///		}
        ///  });
        /// </summary>
        {
            enabled: /// <summary>
            /// A value that determines whether to show animation.
            /// Set this option to false in order to disable easing.
            /// Default: true.
            /// Type: Boolean.
            /// </summary>
            true,
            duration: /// <summary>
            /// The duration option defines the length of the animation effect in milliseconds.
            /// Default: 400.
            /// Type: Number.
            /// </summary>
            400,
            easing: /// <summary>
            /// Sets the type of animation easing effect that users experience when the
            /// wijbarchart series loads on the page.For example, the wijbarchart series
            /// can bounce several times as it loads.
            /// Remark: The easing is defined in Raphael, the documentation is:
            /// http://raphaeljs.com/reference.html#Raphael.easing_formulas
            /// Default: ">".
            /// Type: string.
            /// </summary>
            ">"
        },
        seriesTransition: /// <summary>
        /// Creates the animation object to use when the seriesList data changes.
        /// This allows you to visually show changes in data for the same series.
        /// Note: This animation does not appear when you first load or reload the page--it only
        /// occurs when data changes.
        /// Default: {enabled:true, duration:400, easing: ">"}.
        /// Type: Object.
        /// Code example:
        ///  $(document).ready(function () {
        /// $("#wijbarchart").wijbarchart({
        ///	seriesList: [createRandomSeriesList("2013")],
        ///	seriesTransition: {
        ///		duration: 800,
        ///		easing: "easeOutBounce"
        ///	}
        /// });
        ///	} );
        ///	function reload() {
        ///		$("#wijbarchart").wijbarchart("option", "seriesList", [createRandomSeriesList("2013")]);
        ///	}
        ///	function createRandomSeriesList(label) {
        ///		var data = [],
        ///			randomDataValuesCount = 12,
        ///			labels = ["January", "February", "March", "April", "May", "June",
        ///				"July", "August", "September", "October", "November", "December"],
        ///			idx;
        ///		for (idx = 0; idx < randomDataValuesCount; idx++) {
        ///			data.push(Math.round(Math.random() * 100));
        ///		}
        ///		return {
        ///			label: label,
        ///			legendEntry: false,
        ///			data: { x: labels, y: data }
        ///		};
        ///	}
        /// </summary>
        {
            enabled: /// <summary>
            /// A value that determines whether to show animation in redrawing bars
            /// when the seriesList data changes. Set this option to false to disable this animation.
            /// Default: true.
            /// Type: Boolean.
            /// </summary>
            true,
            duration: /// <summary>
            /// A value that indicates how long to display the series transition animation in milliseconds.
            /// Default: 400.
            /// Type: Number.
            /// </summary>
            400,
            easing: /// <summary>
            /// Sets the type of animation easing effect to use in redrawing bars when the seriesList data changes.
            /// Remark: The easing is defined in Raphael, the documentation is:
            /// http://raphaeljs.com/reference.html#Raphael.easing_formulas
            /// Default: ">".
            /// Type: string.
            /// </summary>
            ">"
        },
        mouseDown: /// <summary>
        /// This event fires when the user clicks a mouse button.
        /// Default: null.
        /// Type: Function.
        /// Code example:
        /// Supply a function as an option.
        ///  $("#barchart").wijbarchart({mouseDown: function(e, data) { } });
        /// Bind to the event by type: wijbarchartmousedown
        /// $("#barchart").bind("wijbarchartmousedown", function(e, data) {} );
        /// </summary>
        /// <param name="e" type="eventObj">
        ///  A jQuery.Event object.
        ///	</param>
        /// <param name="data" type="Object">
        /// An object that contains all the series information for the mousedown bar.
        /// data.bar: the Raphael object of the bar.
        /// data.data: data of the series of the bar.
        /// data.hoverStyle: hover style of series of the bar.
        /// data.index: index of the bar.
        /// data.label: label of the series of the bar.
        /// data.legendEntry: legend entry of the series of the bar.
        /// data.style: style of the series of the bar.
        /// data.type: "bar"
        /// data.x: The x value of the bar.
        /// data.y: the y valuue of the bar.
        ///	</param>
        null,
        mouseUp: /// <summary>BarChartSeries
        /// Fires when the user releases a mouse button
        /// while the pointer is over the chart element.
        /// Default: null.
        /// Type: Function.
        /// Code example:
        /// Supply a function as an option.
        ///  $("#barchart").wijbarchart({mouseUp: function(e, data) { } });
        /// Bind to the event by type: wijbarchartmouseup
        /// $("#barchart").bind("wijbarchartmouseup", function(e, data) {} );
        /// </summary>
        /// <param name="e" type="eventObj">
        /// jQuery.Event object.
        ///	</param>
        /// <param name="data" type="Object">
        /// An object that contains all the series info of the mouse up bar.
        /// data.bar: the Raphael object of the bar.
        /// data.data: data of the series of the bar.
        /// data.hoverStyle: hover style of series of the bar.
        /// data.index: index of the bar.
        /// data.label: label of the series of the bar.
        /// data.legendEntry: legend entry of the series of the bar.
        /// data.style: style of the series of the bar.
        /// data.type: "bar"
        /// data.x: The x value of the bar.
        /// data.y: the y valuue of the bar.
        ///	</param>
        null,
        mouseOver: /// <summary>
        /// Fires when the user first places the pointer over the chart element.
        /// Default: null.
        /// Type: Function.
        /// Code example:
        /// Supply a function as an option.
        ///  $("#barchart").wijbarchart({mouseOver: function(e, data) { } });
        /// Bind to the event by type: wijbarchartmouseover
        /// $("#barchart").bind("wijbarchartmouseover", function(e, data) {} );
        /// </summary>
        /// <param name="e" type="eventObj">
        /// jQuery.Event object.
        ///	</param>
        /// <param name="data" type="Object">
        /// An object that contains all the series infos of the mouseover bar.
        /// data.bar: the Raphael object of the bar.
        /// data.data: data of the series of the bar.
        /// data.hoverStyle: hover style of series of the bar.
        /// data.index: index of the bar.
        /// data.label: label of the series of the bar.
        /// data.legendEntry: legend entry of the series of the bar.
        /// data.style: style of the series of the bar.
        /// data.type: "bar"
        /// data.x: The x value of the bar.
        /// data.y: the y valuue of the bar.
        ///	</param>
        null,
        mouseOut: /// <summary>
        /// Fires when the user moves the pointer off of the chart element.
        /// Default: null.
        /// Type: Function.
        /// Code example:
        /// Supply a function as an option.
        ///  $("#barchart").wijbarchart({mouseOut: function(e, data) { } });
        /// Bind to the event by type: wijbarchartmouseout
        /// $("#barchart").bind("wijbarchartmouseout", function(e, data) {} );
        /// </summary>
        /// <param name="e" type="eventObj">
        /// jQuery.Event object.
        ///	</param>
        /// <param name="data" type="Object">
        /// An object that contains all the series infos of the mouseout bar.
        /// data.bar: the Raphael object of the bar.
        /// data.data: data of the series of the bar.
        /// data.hoverStyle: hover style of series of the bar.
        /// data.index: index of the bar.
        /// data.label: label of the series of the bar.
        /// data.legendEntry: legend entry of the series of the bar.
        /// data.style: style of the series of the bar.
        /// data.type: "bar"
        /// data.x: The x value of the bar.
        /// data.y: the y valuue of the bar.
        ///	</param>
        null,
        mouseMove: /// <summary>
        /// Fires when the user moves the mouse pointer
        /// while it is over a chart element.
        /// Default: null.
        /// Type: Function.
        /// Code example:
        /// Supply a function as an option.
        ///  $("#barchart").wijbarchart({mouseMove: function(e, data) { } });
        /// Bind to the event by type: wijbarchartmousemove
        /// $("#barchart").bind("wijbarchartmousemove", function(e, data) {} );
        /// </summary>
        /// <param name="e" type="eventObj">
        /// jQuery.Event object.
        ///	</param>
        /// <param name="data" type="Object">
        /// An object that contains all the series infos of the mousemove bar.
        /// data.bar: the Raphael object of the bar.
        /// data.data: data of the series of the bar.
        /// data.hoverStyle: hover style of series of the bar.
        /// data.index: index of the bar.
        /// data.label: label of the series of the bar.
        /// data.legendEntry: legend entry of the series of the bar.
        /// data.style: style of the series of the bar.
        /// data.type: "bar"
        /// data.x: The x value of the bar.
        /// data.y: the y valuue of the bar.
        ///	</param>
        null,
        click: /// <summary>
        /// Fires when the user clicks the chart element.
        /// Default: null.
        /// Type: Function.
        /// Code example:
        /// Supply a function as an option.
        ///  $("#barchart").wijbarchart({click: function(e, data) { } });
        /// Bind to the event by type: wijbarchartclick
        /// $("#barchart").bind("wijbarchartclick", function(e, data) {} );
        /// </summary>
        /// <param name="e" type="eventObj">
        /// jQuery.Event object.
        ///	</param>
        /// <param name="data" type="Object">
        /// An object that contains all the series infos of the clicked bar.
        /// data.bar: the Raphael object of the bar.
        /// data.data: data of the series of the bar.
        /// data.hoverStyle: hover style of series of the bar.
        /// data.index: index of the bar.
        /// data.label: label of the series of the bar.
        /// data.legendEntry: legend entry of the series of the bar.
        /// data.style: style of the series of the bar.
        /// data.type: "bar"
        /// data.x: The x value of the bar.
        /// data.y: the y valuue of the bar.
        ///	</param>
        null
    });
    WijBarChart.prototype.widgetEventPrefix = "wijbarchart";
    //$.widget("wijmo.wijbarchart", WijBarChart.prototype);
    $.wijmo.registerWidget("wijbarchart", WijBarChart.prototype);
    var XSpec = (function () {
        function XSpec(nx) {
            this.x = nx;
            this.paSpec = [];
        }
        XSpec.prototype.stackValues = function () {
            var self = this, len = self.paSpec.length, ps0;
            if(len > 1) {
                ps0 = self.paSpec[0];
                $.each(self.paSpec, function (idx, ps) {
                    if(idx === 0) {
                        return true;
                    }
                    ps.y += ps0.y;
                    ps0 = ps;
                });
            }
        };
        return XSpec;
    })();    
    // render the bar chart.
    var BarChartRender = (function () {
        function BarChartRender(element, options) {
            this.options = options;
            this.element = element;
            this._init();
        }
        BarChartRender.prototype._init = function () {
            var o = this.options, inverted = o.horizontal, xaxis = o.axis.x, bounds = o.bounds;
            this.startLocation = {
                x: bounds.startX,
                y: bounds.startY
            };
            this.width = bounds.endX - this.startLocation.x;
            this.height = bounds.endY - this.startLocation.y;
            this.nSeries = o.seriesList.length , this.seriesList = $.arrayClone(o.seriesList);
            this.seriesStyles = [].concat(o.seriesStyles.slice(0, this.nSeries));
            this.seriesHoverStyles = [].concat(o.seriesHoverStyles.slice(0, this.nSeries));
            this.xscale = wijmo.ChartUtil.getScaling(inverted, xaxis.max, xaxis.min, inverted ? this.height : this.width);
            this.xlate = wijmo.ChartUtil.getTranslation(inverted, this.startLocation, xaxis.max, xaxis.min, this.xscale);
            this.fields = this.element.data("fields") || {
            };
            this.chartElements = this.fields.chartElements || {
            };
            this.aniBarsAttr = this.fields.aniBarsAttr;
            this.canvas = o.canvas;
        };
        BarChartRender.prototype._paintShadow = function (element, offset, stroke) {
            if(this.options.shadow) {
                wijmo.ChartUtil.paintShadow(element, offset, stroke);
            }
        };
        BarChartRender.prototype.getMinDX = function (x) {
            var minDx = Number.MAX_VALUE, len = x.length, idx, dx;
            for(idx = 1; idx < len; idx++) {
                dx = x[idx].x - x[idx - 1].x;
                if(dx < minDx && dx > 0) {
                    minDx = dx;
                }
            }
            if(minDx === Number.MAX_VALUE) {
                return 2;
            }
            return minDx;
        };
        BarChartRender.prototype.stackValues = function (x) {
            $.each(x, function (idx, xSpec) {
                xSpec.stackValues();
            });
            return x;
        };
        BarChartRender.prototype.barPointList = function (seriesList) {
            var x = [], getXSortedPoints = wijmo.ChartUtil.getXSortedPoints;
            function addSeriesData(idx, series) {
                var points = getXSortedPoints(series), nSeries = series.length, xs = null, lim = 0, j = 0, jlim = 0, first_point = true, xprev = 0, dupl = false;
                if(points) {
                    lim = points.length;
                }
                if(x) {
                    jlim = x.length;
                }
                if(points === undefined) {
                    return;
                }
                $.each(points, function (p, point) {
                    if(first_point) {
                        first_point = false;
                        xprev = point.x;
                    } else {
                        if(xprev === point.x) {
                            dupl = true;
                        } else {
                            dupl = false;
                        }
                        xprev = point.x;
                    }
                    while(j < jlim && x[j].x < point.x) {
                        j++;
                    }
                    if(j < jlim) {
                        // use or insert before the existing item
                        if(x[j].x !== point.x) {
                            xs = new XSpec(point.x);
                            x.splice(j, 0, xs);
                            jlim = x.length;
                        } else {
                            xs = x[j];
                        }
                    } else {
                        // add a new item
                        xs = new XSpec(point.x);
                        x.push(xs);
                        jlim = x.length;
                    }
                    xs.paSpec.push({
                        y: point.y,
                        sIdx: idx,
                        pIdx: p,
                        dupl: dupl
                    });
                });
            }
            $.each(seriesList, function (idx, series) {
                addSeriesData(idx, series);
            });
            return x;
        };
        BarChartRender.prototype.adjustToLimits = function (val, min, max) {
            if(val < min) {
                return min;
            }
            if(val > max) {
                return max;
            }
            return val;
        };
        BarChartRender.prototype.transformPoints = function (inverted, xscale, yscale, xlate, ylate, points) {
            $.each(points, function (idx, point) {
                var x = point.x, y = point.y, temp = 0;
                point.x = xscale * x + xlate;
                point.y = yscale * y + ylate;
                if(inverted) {
                    temp = point.x;
                    point.x = point.y;
                    point.y = temp;
                }
            });
            return points;
        };
        BarChartRender.prototype.paintDefaultChartLabel = function (rf, y, isTime, seriesTextStyle) {
            var options = this.options, inverted = options.horizontal, canvas = options.canvas, wijCSS = options.wijCSS, culture = options.culture, textStyle = $.extend(true, {
            }, options.textStyle, options.chartLabelStyle), pos = inverted ? {
                x: rf.x + rf.width,
                y: rf.y + rf.height / 2
            } : {
                x: rf.x + rf.width / 2,
                y: rf.y
            }, chartLabelFormatString = options.chartLabelFormatString, dclBox, defaultChartLabel, widget = this.options.widget, text = y;
            if(seriesTextStyle) {
                textStyle = $.extend(true, textStyle, seriesTextStyle);
            }
            /*if (isTime) {
            text = $.wijchart.fromOADate(y);
            } else {
            text = $.wijchart.round(y, 2);
            }*/
            if(isTime) {
                text = $.fromOADate(y);
            }
            if(chartLabelFormatString && chartLabelFormatString.length) {
                //text = $.format(text, o.chartLabelFormatString);
                text = Globalize.format(text, options.chartLabelFormatString, culture);
            } else if(!isTime) {
                text = $.round(text, 2);
            }
            defaultChartLabel = widget._text.call(widget, pos.x, pos.y, text).attr(textStyle);
            $.wijraphael.addClass($(defaultChartLabel.node), wijCSS.barLabel);
            dclBox = defaultChartLabel.getBBox();
            if(inverted) {
                defaultChartLabel.attr({
                    x: pos.x + dclBox.width / 2
                });
            } else {
                defaultChartLabel.attr({
                    y: pos.y - dclBox.height / 2
                });
            }
            return defaultChartLabel;
        };
        BarChartRender.prototype.paintBar = function (rp, y, height, xAxisInfo, yAxisInfo, seriesStyle, animated, shadowOffset, startLocation, clusterOverlap, preY, lastY, isYTime, seriesTextStyle, yaxis) {
            var o = this.options, stacked = o.stacked, inverted = o.horizontal, is100Percent = o.is100Percent, xmin = xAxisInfo.min, xmax = xAxisInfo.max, ymin = yAxisInfo.min, ymax = yAxisInfo.max, xscale = xAxisInfo.scale, xlate = xAxisInfo.late, yscale = yAxisInfo.scale, ylate = yAxisInfo.late, hold, x, inPlotArea, rf, defaultChartLabel = null, r, style = seriesStyle, strokeWidth = seriesStyle["stroke-width"], stroke = seriesStyle.stroke, bar, barWidth, barHeight, animatedBar, start = -1;
            if(yaxis.origin !== null) {
                start = yscale * yaxis.origin + ylate;
            }
            if(stacked) {
                if(is100Percent) {
                    if(lastY > 0) {
                        rp.height = y / lastY;
                    }
                    if(preY || preY === 0) {
                        rp.y = preY / lastY;
                        rp.height -= rp.y;
                    }
                } else {
                    rp.height = y;
                    if(preY || preY === 0) {
                        rp.height -= preY;
                        rp.y = preY;
                    }
                }
            } else {
                if(preY || preY === 0) {
                    // 1 bar over less overlap and 1 pixel
                    rp.x += rp.width * (1 - clusterOverlap);
                    rp.height = y;
                }
            }
            x = [
                {
                    x: rp.x,
                    y: rp.y
                }, 
                {
                    x: rp.x + rp.width,
                    y: rp.y + rp.height
                }
            ];
            inPlotArea = ((xmin <= x[0].x && x[0].x <= xmax) || (xmin <= x[1].x && x[1].x <= xmax)) && ((ymin <= x[0].y && x[0].y <= ymax) || (ymin <= x[1].y && x[1].y <= ymax));
            x[0].x = this.adjustToLimits(x[0].x, xmin, xmax);
            x[0].y = this.adjustToLimits(x[0].y, ymin, ymax);
            x[1].x = this.adjustToLimits(x[1].x, xmin, xmax);
            x[1].y = this.adjustToLimits(x[1].y, ymin, ymax);
            x = this.transformPoints(inverted, xscale, yscale, xlate, ylate, x);
            if(x[0].x > x[1].x) {
                hold = x[0].x;
                x[0].x = x[1].x;
                x[1].x = hold;
            }
            if(x[0].y > x[1].y) {
                hold = x[0].y;
                x[0].y = x[1].y;
                x[1].y = hold;
            }
            rf = {
                x: x[0].x,
                y: x[0].y,
                width: x[1].x - x[0].x,
                height: x[1].y - x[0].y
            };
            if(inPlotArea && !stacked) {
                if(rf.width === 0) {
                    rf.width = 1;
                }
                if(rf.height === 0) {
                    rf.height = 1;
                    rf.y -= 1;
                }
            }
            if(o.showChartLabels) {
                defaultChartLabel = this.paintDefaultChartLabel(rf, y, isYTime, seriesTextStyle);
            }
            r = seriesStyle.r ? seriesStyle.r : o.clusterRadius;
            if(r) {
                style = $.extend(true, {
                }, seriesStyle, {
                    r: 0
                });
            }
            if(stroke !== "none" && strokeWidth) {
                strokeWidth = parseInt(strokeWidth, 10);
            }
            if(!strokeWidth || isNaN(strokeWidth)) {
                strokeWidth = 0;
            }
            barWidth = rf.width;
            barHeight = rf.height;
            if(strokeWidth > 1) {
                strokeWidth--;
                barWidth = rf.width - strokeWidth;
                barHeight = rf.height - strokeWidth / 2;
                rf.x += strokeWidth / 2;
            }
            if(barWidth < 0) {
                barWidth = 0;
            }
            if(barHeight < 0) {
                barHeight = 0;
            }
            if(animated) {
                if(start === -1) {
                    if(inverted) {
                        start = startLocation.x + strokeWidth / 2;
                    } else {
                        start = startLocation.y + height - strokeWidth / 2;
                    }
                }
                if(r) {
                    if(inverted) {
                        if(y > yaxis.origin) {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, 0, 0, r, r).hide();
                        } else {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, r, r, 0, 0).hide();
                        }
                        animatedBar = this.canvas.rect(start, rf.y, 0, barHeight);
                    } else {
                        if(y > yaxis.origin) {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, r, 0, 0, r).hide();
                        } else {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, 0, r, r, 0).hide();
                        }
                        animatedBar = this.canvas.rect(rf.x, start, rf.width, 0);
                    }
                    this._paintShadow(animatedBar, shadowOffset);
                    animatedBar.wijAttr(style);
                    animatedBar.bar = bar;
                } else {
                    if(inverted) {
                        bar = this.canvas.rect(start, rf.y, 0, barHeight);
                    } else {
                        bar = this.canvas.rect(rf.x, start, barWidth, 0);
                    }
                    animatedBar = bar;
                }
                if(defaultChartLabel) {
                    defaultChartLabel.attr({
                        opacity: 0
                    });
                    animatedBar.chartLabel = defaultChartLabel;
                }
                animatedBar.left = rf.x;
                animatedBar.top = rf.y;
                animatedBar.width = barWidth;
                animatedBar.height = barHeight;
                animatedBar.r = r;
            } else {
                if(r) {
                    if(inverted) {
                        if(y > yaxis.origin) {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, 0, 0, r, r);
                        } else {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, r, r, 0, 0);
                        }
                    } else {
                        if(y > yaxis.origin) {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, r, 0, 0, r);
                        } else {
                            bar = this.canvas.roundRect(rf.x, rf.y, barWidth, barHeight, 0, r, r, 0);
                        }
                    }
                } else {
                    bar = this.canvas.rect(rf.x, rf.y, barWidth, barHeight);
                }
            }
            this._paintShadow(bar, shadowOffset);
            if(animated && r) {
                if(bar.shadow) {
                    bar.shadow.hide();
                }
            }
            bar.wijAttr(seriesStyle);
            return {
                rect: rf,
                dcl: defaultChartLabel,
                animatedBar: animatedBar,
                bar: bar
            };
        };
        BarChartRender.prototype.paintClusters = function (seriesList, seriesStyles, seriesHoverStyles, xAxisInfo, yAxisInfo, width, height, startLocation, isYTime, isXTime) {
            var self = this, o = self.options, clusterOverlap = o.clusterOverlap / 100, clusterWidth = o.clusterWidth / 100, shadowOffset = 1, clusterSpacing = o.clusterSpacing + shadowOffset, nSeries = seriesList.length, canvas = o.canvas, stacked = o.stacked, inverted = o.horizontal, yaxis = o.axis.y, widget = o.widget, wijCSS = o.wijCSS, animated = o.animation && o.animation.enabled, bpl, bw, pointX, chartLabels = [], bars = [], animatedBars = [], rects = [], sList = //isYTime = yAxisInfo.isTime,
            [], seriesEles = [], trackers = canvas.set(), tooltipObj, strokeWidth = 0;
            if(isYTime || isXTime) {
                $.each(seriesList, function (i, s) {
                    var se = $.extend(true, {
                    }, s);
                    if(se.data && se.data.y && se.data.y.length && isYTime) {
                        $.each(se.data.y, function (idx, data) {
                            se.data.y[idx] = $.toOADate(data);
                        });
                    }
                    if(se.data && se.data.x && se.data.x.length && isXTime) {
                        $.each(se.data.x, function (idx, data) {
                            se.data.x[idx] = $.toOADate(data);
                        });
                    }
                    sList.push(se);
                });
                bpl = self.barPointList(sList);
            } else {
                bpl = self.barPointList(seriesList);
            }
            if(stacked) {
                bpl = self.stackValues(bpl);
            }
            bw = self.getMinDX(bpl) * clusterWidth;
            // fixed an issue that if the stroke-width is not 0, if set the clusterSpacing to small,
            // some bars are shows too close.
            $.each(seriesStyles, function (i, st) {
                if(st["stroke-width"] && !isNaN(st["stroke-width"])) {
                    if(strokeWidth !== 0) {
                        strokeWidth = Math.min(parseFloat(st["stroke-width"]), strokeWidth);
                    } else {
                        strokeWidth = parseFloat(st["stroke-width"]);
                    }
                }
            });
            // adjust the bar width (bw) to account for overlap
            if(nSeries > 1 && !stacked) {
                clusterOverlap -= (bpl.length * (nSeries - 1) * (clusterSpacing + strokeWidth * 2)) / (inverted ? height : width);
                bw /= (nSeries * (1 - clusterOverlap) + clusterOverlap);
            }
            $.each(bpl, function (bplIdx, xs) {
                var ps = xs.paSpec, ns = ps.length, sx, rp, bar, barInfo;
                if(stacked) {
                    sx = bw;
                } else {
                    sx = (bw * (ns * (1 - clusterOverlap) + clusterOverlap));
                }
                // calculate the first series rectangle
                rp = {
                    x: xs.x - sx / 2,
                    y: 0,
                    width: bw,
                    height: ps[0].y
                };
                $.each(ps, function (psIndex, points) {
                    // if the array data.x's length is more than the data.y's,
                    // the rp.height is undefined. it will cause wrong.
                    if(rp.height === undefined) {
                        return true;
                    }
                    var sIdx = points.sIdx, pIdx = points.pIdx, seriesStyle = seriesStyles[sIdx], series = seriesList[sIdx], tracker, yAxisIndex = series.yAxis || 0, axisY = yaxis[yAxisIndex] || yaxis, axisInfoY = yAxisInfo[yAxisIndex] || yAxisInfo;
                    if(!rects[sIdx]) {
                        rects[sIdx] = [];
                    }
                    if(!seriesEles[sIdx]) {
                        seriesEles[sIdx] = [];
                    }
                    self.yscale = wijmo.ChartUtil.getScaling(!inverted, axisY.max, axisY.min, inverted ? width : height);
                    self.ylate = wijmo.ChartUtil.getTranslation(!inverted, startLocation, axisY.max, axisY.min, self.yscale);
                    axisInfoY.late = self.ylate;
                    axisInfoY.scale = self.yscale;
                    barInfo = self.paintBar(rp, points.y, height, xAxisInfo, axisInfoY, seriesStyle, animated, shadowOffset, startLocation, clusterOverlap, psIndex > 0 ? ps[psIndex - 1].y : null, ps[ps.length - 1].y, isYTime, series.textStyle, axisY);
                    bar = barInfo.bar;
                    tracker = bar.clone().attr(// In IE, if the tracker has an stroke width,
                    // the bar will show an black border.
                    {
                        opacity: 0.01,
                        fill: "white",
                        "stroke-width": 0,
                        "fill-opacity": 0.01
                    });
                    if(series.visible === false) {
                        bar.hide();
                        if(barInfo.dcl) {
                            barInfo.dcl.hide();
                        }
                        tracker.hide();
                        if(bar.shadow) {
                            bar.shadow.hide();
                        }
                    }
                    $.wijraphael.addClass($(bar.node), wijCSS.canvasObject + " " + wijCSS.barElement);
                    tooltipObj = $.extend(false, {
                        index: pIdx,
                        bar: bar,
                        type: "bar",
                        style: seriesStyle,
                        hoverStyle: seriesHoverStyles[sIdx],
                        x: series.data.x[pIdx],
                        y: series.data.y[pIdx],
                        visible: true
                    }, series);
                    $(bar.node).data("wijchartDataObj", tooltipObj);
                    // cache the bar position to show indicator line.
                    //if()
                    widget.dataPoints = widget.dataPoints || {
                    };
                    widget.pointXs = widget.pointXs || [];
                    if(o.horizontal) {
                        pointX = $.round(barInfo.rect.y + barInfo.rect.height / 2, 2);
                    } else {
                        pointX = $.round(barInfo.rect.x + barInfo.rect.width / 2, 2);
                    }
                    if(!widget.dataPoints[pointX.toString()]) {
                        widget.dataPoints[pointX.toString()] = [];
                        widget.pointXs.push(pointX);
                    }
                    widget.dataPoints[pointX.toString()].push(tooltipObj);
                    $(tracker.node).data("owner", $(bar.node));
                    $.wijraphael.addClass($(tracker.node), wijCSS.barElement + " " + wijCSS.barTracker);
                    barInfo.bar.tracker = tracker;
                    trackers.push(tracker);
                    bars.push(bar);
                    if(barInfo.animatedBar) {
                        animatedBars.push(barInfo.animatedBar);
                    }
                    if(barInfo.dcl) {
                        chartLabels.push(barInfo.dcl);
                    }
                    rects[sIdx][pIdx] = barInfo.rect;
                    seriesEles[sIdx][pIdx] = barInfo;
                    bar = null;
                    tracker = null;
                });
            });
            //set default chart label to front.
            $.each(chartLabels, function (sIdx, chartLabel) {
                chartLabel.toFront();
            });
            trackers.toFront();
            return {
                bars: bars,
                animatedBars: animatedBars,
                rects: rects,
                chartLabels: chartLabels,
                seriesEles: seriesEles,
                trackers: trackers
            };
        };
        BarChartRender.prototype.playAnimation = function (animatedBars) {
            var self = this, o = self.options, animation = o.animation, animated = animation && animation.enabled, inverted = o.horizontal, seriesTransition = o.seriesTransition, duration, easing, barsAttr = [], diffAttr, chartLabelStyle = o.chartLabelStyle;
            if(animated) {
                duration = animation.duration || 2000;
                easing = animation.easing || "linear";
                $.each(animatedBars, function (idx, animatedBar) {
                    var params;
                    if(inverted) {
                        params = {
                            width: animatedBar.width,
                            x: animatedBar.left
                        };
                    } else {
                        params = {
                            height: animatedBar.height,
                            y: animatedBar.top
                        };
                    }
                    if(self.aniBarsAttr && seriesTransition.enabled) {
                        if(self.aniBarsAttr.length > idx) {
                            diffAttr = wijmo.ChartUtil.getDiffAttrs(self.aniBarsAttr[idx], animatedBar.attr());
                            if(inverted) {
                                diffAttr.x = self.aniBarsAttr[idx].x;
                                diffAttr.width = self.aniBarsAttr[idx].width;
                            } else {
                                diffAttr.y = self.aniBarsAttr[idx].y;
                                diffAttr.height = self.aniBarsAttr[idx].height;
                            }
                            if(diffAttr.path) {
                                delete diffAttr.path;
                            }
                            animatedBar.attr(diffAttr);
                            duration = seriesTransition.duration;
                            easing = seriesTransition.easing;
                        }
                    }
                    barsAttr.push($.extend(true, {
                    }, animatedBar.attr(), params));
                    if(animatedBar.tracker) {
                        animatedBar.tracker.hide();
                    }
                    animatedBar.stop().wijAnimate(params, duration, easing, function () {
                        var b = this, r = b.r, bar = b;
                        if(b.chartLabel) {
                            // fixed an issue that if the chart label's opacity is not 1,
                            // this code will change the opacity.
                            if(chartLabelStyle && chartLabelStyle.opacity) {
                                b.chartLabel.wijAnimate({
                                    opacity: chartLabelStyle.opacity
                                }, 250);
                            } else {
                                b.chartLabel.wijAnimate({
                                    opacity: 1
                                }, 250);
                            }
                        }
                        if(b.tracker) {
                            b.tracker.show();
                            b.tracker.attr({
                                width: b.width,
                                height: b.height,
                                x: b.attr("x"),
                                y: b.attr("y")
                            });
                        }
                        if(r) {
                            bar = b.bar;
                            bar.show();
                            if(bar.shadow) {
                                bar.shadow.show();
                            }
                            if(b.shadow) {
                                b.shadow.wijRemove();
                                b.shadow = null;
                            }
                            b.wijRemove();
                            //bar.animatedBar = null;
                            b = null;
                        }
                    });
                });
                self.aniBarsAttr = barsAttr;
            }
        };
        BarChartRender.prototype.bindLiveEvents = function () {
            var o = this.options, wijCSS = o.wijCSS, widgetName = o.widgetName, disabled = o.disabled, mouseDown = o.mouseDown, mouseUp = o.mouseUp, mouseOver = o.mouseOver, mouseOut = o.mouseOut, mouseMove = o.mouseMove, click = o.click, element = this.element, isFunction = $.isFunction;
            //				if (hintEnable && !tooltip) {
            //					hint = $.extend(true, {}, options.hint);
            //					hint.offsetY = hint.offsetY || -2;
            //					title = hint.title;
            //					content = hint.content;
            //					if ($.isFunction(title)) {
            //						hint.title = function () {
            //							return getTooltipText(title, this.target);
            //						};
            //					}
            //					if ($.isFunction(content)) {
            //						hint.content = function () {
            //							return getTooltipText(content, this.target);
            //						};
            //					}
            //					hint.beforeShowing = function () {
            //						if (this.target) {
            //						this.options.style.stroke =
            //							this.target.attrs.stroke ||
            //								this.target.attrs.fill;
            //						}
            //					};
            //					tooltip = canvas.tooltip(bars, hint);
            //				}
            $("." + wijCSS.barElement, element[0]).on("mousedown." + widgetName, function (e) {
                if(disabled) {
                    return;
                }
                if(isFunction(mouseDown)) {
                    var target = $(e.target), dataObj;
                    if(target.data("owner")) {
                        target = target.data("owner");
                    }
                    dataObj = target.data("wijchartDataObj");
                    mouseDown.call(element, e, dataObj);
                    dataObj = null;
                }
            }).on("mouseup." + widgetName, function (e) {
                if(disabled) {
                    return;
                }
                if(isFunction(mouseUp)) {
                    var target = $(e.target), dataObj;
                    if(target.data("owner")) {
                        target = target.data("owner");
                    }
                    dataObj = target.data("wijchartDataObj");
                    mouseUp.call(element, e, dataObj);
                    dataObj = null;
                }
            }).on("mouseover." + widgetName, function (e) {
                if(disabled) {
                    return;
                }
                if(isFunction(mouseOver)) {
                    var target = $(e.target), dataObj;
                    if(target.data("owner")) {
                        target = target.data("owner");
                    }
                    dataObj = target.data("wijchartDataObj");
                    mouseOver.call(element, e, dataObj);
                    dataObj = null;
                }
            }).on("mouseout." + widgetName, function (e) {
                if(disabled) {
                    return;
                }
                var target = $(e.target), dataObj, bar;
                if(target.data("owner")) {
                    target = target.data("owner");
                }
                dataObj = target.data("wijchartDataObj");
                bar = dataObj.bar;
                if(!dataObj.hoverStyle) {
                    if(bar) {
                        bar.attr({
                            opacity: "1"
                        });
                    }
                } else {
                    bar.attr(dataObj.style);
                }
                if(isFunction(mouseOut)) {
                    mouseOut.call(element, e, dataObj);
                }
                dataObj = null;
                //if (tooltip) {
                //	tooltip.hide();
                //}
                            }).on("mousemove." + widgetName, function (e) {
                if(disabled) {
                    return;
                }
                var target = $(e.target), dataObj, bar;
                if(target.data("owner")) {
                    target = target.data("owner");
                }
                dataObj = target.data("wijchartDataObj");
                bar = dataObj.bar;
                if(!dataObj.hoverStyle) {
                    if(bar) {
                        bar.attr({
                            opacity: "0.8"
                        });
                    }
                } else {
                    bar.attr(dataObj.hoverStyle);
                }
                if(isFunction(mouseMove)) {
                    mouseMove.call(element, e, dataObj);
                }
                dataObj = null;
                //end of code for adding hover state effect.
                            }).on("click." + widgetName, function (e) {
                if(disabled) {
                    return;
                }
                if(isFunction(click)) {
                    var target = $(e.target), dataObj;
                    if(target.data("owner")) {
                        target = target.data("owner");
                    }
                    dataObj = target.data("wijchartDataObj");
                    click.call(element, e, dataObj);
                }
            });
        };
        BarChartRender.prototype.unbindLiveEvents = function () {
            var o = this.options, widgetName = o.widgetName, wijCSS = o.wijCSS, element = this.element;
            // TO DO
            $("." + wijCSS.barElement, element[0]).off(widgetName).off(// for jQuery 1.7.1
            "." + widgetName);
        };
        BarChartRender.prototype.render = function () {
            var o = this.options, inverted = o.horizontal, stacked = o.stacked, seriesList = this.seriesList, seriesStyles = this.seriesStyles, seriesHoverStyles = this.seriesHoverStyles, xaxis = o.axis.x, yaxis = o.axis.y, isYTime = o.isYTime, isXTime = o.isXTime, clusterInfos;
            this.unbindLiveEvents();
            if(inverted && !stacked) {
                seriesList.reverse();
                seriesStyles.reverse();
                seriesHoverStyles.reverse();
            }
            if(this.nSeries === 0) {
                return;
            }
            clusterInfos = this.paintClusters(seriesList, seriesStyles, seriesHoverStyles, {
                min: xaxis.min,
                max: xaxis.max,
                late: this.xlate,
                scale: this.xscale
            }, yaxis, this.width, this.height, this.startLocation, isYTime, isXTime);
            this.element.data("plotInfos", {
                xscale: this.xscale,
                xlate: this.xlate,
                yscale: this.yscale,
                ylate: this.ylate,
                rects: clusterInfos.rects
            });
            this.playAnimation(clusterInfos.animatedBars);
            //bars = clusterInfos.bars;
            this.chartElements.bars = clusterInfos.bars;
            this.chartElements.animatedBars = clusterInfos.animatedBars;
            this.chartElements.chartLabels = clusterInfos.chartLabels;
            this.fields.seriesEles = clusterInfos.seriesEles;
            this.fields.trackers = clusterInfos.trackers;
            //fields.chartElements = chartElements;
            if(!this.fields.chartElements) {
                this.fields.chartElements = {
                };
            }
            if(inverted && !stacked) {
                this.fields.seriesEles.reverse();
            }
            $.extend(true, this.fields.chartElements, this.chartElements);
            this.fields.aniBarsAttr = this.aniBarsAttr;
            this.element.data("fields", this.fields);
            this.bindLiveEvents();
        };
        return BarChartRender;
    })();
    wijmo.BarChartRender = BarChartRender;    
})(wijmo || (wijmo = {}));