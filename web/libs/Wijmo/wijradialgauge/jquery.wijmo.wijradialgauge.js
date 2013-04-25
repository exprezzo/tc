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
/// <reference path="../wijgauge/jquery.wijmo.wijgauge.ts"/>
/*globals $, Raphael, jQuery, document, window*/
/*
* Depends:
*  jQuery.1.5.1.js
*  jQuery.ui.core.js
*  jQuery.ui.widget.js
*	raphael.js
*	globalize.min.js
*	jquery.wijmo.raphael.js
*/
var wijmo;
(function (wijmo) {
    var _zeroOffset = 180, interpMinPoints = 9, interJump = 5;
    var WijRadialGauge = (function (_super) {
        __extends(WijRadialGauge, _super);
        function WijRadialGauge() {
            _super.apply(this, arguments);

        }
        WijRadialGauge.prototype._create = function () {
            var self = this;
            _super.prototype._create.call(this);
            self.element.addClass(this.options.wijCSS.radialGauge);
        };
        WijRadialGauge.prototype._set_radius = function () {
            var self = this;
            self._redrawMarksAndLabels();
            self.pointer.wijRemove();
            self._paintPointer();
            self._setPointer();
        };
        WijRadialGauge.prototype._set_startAngle = function () {
            var self = this;
            self._redrawMarksAndLabels();
            self._setPointer();
        };
        WijRadialGauge.prototype._set_sweepAngle = function (value) {
            var self = this;
            if(value > 360) {
                self.options.endAngle = 360;
            }
            self._redrawMarksAndLabels();
            self._setPointer();
        };
        WijRadialGauge.prototype._set_width = function () {
            var self = this;
            self._autoCalculate();
            _super.prototype._set_width.call(this);
        };
        WijRadialGauge.prototype._set_height = function () {
            var self = this;
            self._autoCalculate();
            _super.prototype._set_height.call(this);
        };
        WijRadialGauge.prototype._set_origin = function () {
            var self = this;
            self._autoCalculate();
        };
        WijRadialGauge.prototype._set_cap = function () {
            var self = this;
            self.pointer.wijRemove();
            self._paintPointer();
            self._setPointer();
        };
        WijRadialGauge.prototype._clearState = function () {
            _super.prototype._clearState.call(this);
            this.markBbox = null;
        };
        WijRadialGauge.prototype._valueToAngleIncludeOffset = function (value) {
            return wijmo.GaugeUtil.mod360(this._valueToAngle(value) + _zeroOffset);
        };
        WijRadialGauge.prototype._valueToAngle = function (value) {
            var self = this, alpha = self._valueToLogical(value);
            return self._logicalToAngle(alpha);
        };
        WijRadialGauge.prototype._angleToValue = function (angle) {
            var self = this, alpha = self._angleToLogical(angle);
            return self._logicalToValue(alpha);
        };
        WijRadialGauge.prototype._logicalToAngle = function (alpha) {
            var self = this, o = self.options, startAngle = o.startAngle, sweepAngle = o.sweepAngle, isInverted = o.isInverted;
            if(isInverted) {
                return startAngle * alpha + (startAngle + sweepAngle) * (1 - alpha);
            } else {
                return startAngle * (1 - alpha) + (startAngle + sweepAngle) * alpha;
            }
        };
        WijRadialGauge.prototype._angleToLogical = function (angle) {
            var self = this, o = self.options, startAngle = o.startAngle, isInverted = o.isInverted, relativeAngle = wijmo.GaugeUtil.mod360(angle - startAngle), absSweepAngle = o.sweepAngle, overflow, underflow;
            if(absSweepAngle === 0 || relativeAngle === 0) {
                return isInverted ? 1 : 0;
            }
            if(absSweepAngle < 0) {
                relativeAngle = 360 - relativeAngle;
                absSweepAngle = -absSweepAngle;
            }
            overflow = relativeAngle - absSweepAngle;
            if(overflow > 0) {
                underflow = 360 - relativeAngle;
                return overflow < underflow ? 1 : 0;
            }
            if(isInverted) {
                return 1 - relativeAngle / absSweepAngle;
            } else {
                return relativeAngle / absSweepAngle;
            }
        };
        WijRadialGauge.prototype._generatePoints = function (fromAngle, toAngle, fromLength, toLength) {
            var self = this, isInverted = self.options.isInverted, max = parseInt((interpMinPoints + interpMinPoints * (Math.abs(parseInt((toAngle - fromAngle).toString(), 10)) / (interpMinPoints * interJump))).toString(), 10), points = [], alpha, length, value, angle, i;
            for(i = 0; i < max; i++) {
                alpha = i / (max - 1);
                length = fromLength + (toLength - fromLength) * alpha;
                angle = fromAngle + (toAngle - fromAngle) * alpha;
                value = self._angleToValue(angle);
                points.push(self._valueToPoint(value, length));
            }
            return points;
        };
        WijRadialGauge.prototype._valueToPoint = function (value, offset) {
            var self = this, angle = self._valueToAngleIncludeOffset(value) * Math.PI / 180, radius = offset;
            return {
                x: radius * Math.cos(angle),
                y: radius * Math.sin(angle)
            };
        };
        WijRadialGauge.prototype._pointToValue = function (point) {
            var angle = wijmo.GaugeUtil.mod360(Math.atan2(point.x, -point.y) * 180 / Math.PI);
            return this._angleToValue(angle);
        };
        WijRadialGauge.prototype._radiusScreen = function (offset) {
            var self = this, o = self.options;
            return Math.max(o.radius * offset, 0);
        };
        WijRadialGauge.prototype._autoCalculate = function () {
            var self = this, o = self.options, width = o.width, height = o.height, majorMarkWidth, minorMarkWidth, labelWidth, maxText = wijmo.GaugeUtil.formatString(o.max, o.labels.format), offset = 0, faceBorder, innerHeight = height - o.marginTop - o.marginBottom, innerWidth = //add by DH
            width - o.marginLeft - o.marginRight;
            //add by DH
                        //self.centerPoint = { x: width * o.origin.x, y: height * o.origin.y };
            self.centerPoint = {
                x: o.marginLeft + innerWidth * o.origin.x,
                y: o.marginTop + innerHeight * o.origin.y
            };
            self.radius = o.radius;
            if(o.radius === "auto") {
                //self.faceRadius = Math.min(width, height) / 2;
                self.faceRadius = Math.min(innerWidth, innerHeight) / 2//add by DH
                ;
                faceBorder = self._getFaceBorder();
                self.faceRadius -= faceBorder;
                if(o.tickMajor.position === "inside") {
                    self.faceRadius -= self._getMaxRangeWidth();
                }
                majorMarkWidth = self._getMarkerbbox(o.tickMajor).width;
                minorMarkWidth = self._getMarkerbbox(o.tickMinor).width;
                labelWidth = self._getLabelBBox(maxText).width;
                if(o.tickMajor.position === "center") {
                    offset -= majorMarkWidth / 2;
                    offset -= labelWidth;
                } else if(o.tickMajor.position === "outside") {
                    offset -= majorMarkWidth;
                    offset -= labelWidth;
                }
                if(o.tickMinor.position === "center") {
                    offset = Math.min(offset, -minorMarkWidth / 2);
                } else if(o.tickMinor.position === "outside") {
                    offset = Math.min(offset, -minorMarkWidth);
                }
                self.radius = self.faceRadius + offset;
            }
        };
        WijRadialGauge.prototype._getFaceBorder = function () {
            var self = this, face = self._paintFace(), width = face.attr("stroke-width") || 1;
            if(face.type === "set") {
                width = face[0].attr("stroke-width") || 1;
            }
            face.wijRemove();
            return width;
        };
        WijRadialGauge.prototype._getMaxRangeWidth = function () {
            var self = this, o = self.options, maxWidth = 0;
            $.each(o.ranges, function (i, n) {
                maxWidth = Math.max(maxWidth, n.width || 0);
                maxWidth = Math.max(maxWidth, n.startWidth || 0);
                maxWidth = Math.max(maxWidth, n.endWidth || 0);
            });
            return maxWidth;
        };
        WijRadialGauge.prototype._getMarkerbbox = function (opt) {
            var self = this, mark = self._paintMarkEle(opt), bbox = mark.wijGetBBox();
            mark.wijRemove();
            return {
                width: bbox.width,
                height: bbox.height
            };
        };
        WijRadialGauge.prototype._paintMark = function (value, opt, isMajor) {
            var self = this, mark, position = opt.position || "inside", offset = opt.offset || 0;
            mark = self._paintMarkEle(opt);
            mark.attr(opt.style);
            $.wijraphael.addClass($(mark.node), self.options.wijCSS.radialGaugeMarker);
            $(mark.node).data("value", value);
            self._applyAlignment(mark, position, offset);
            self._setMarkValue(value, mark);
            return mark;
        };
        WijRadialGauge.prototype._applyAlignment = function (ele, alignment, offset) {
            if(!ele) {
                return;
            }
            var Bbox = ele.wijGetBBox(), halfWidth = Bbox.width / 2, left = 0;
            switch(alignment) {
                case "outside":
                    left -= (halfWidth + offset);
                    break;
                case "inside":
                    left += (halfWidth + offset);
                    break;
            }
            //ele.attr("translation", left + "," + 0);
            //ele.attr("transform", "t" + left + "," + 0);
            ele.transform("t" + left + "," + 0);
        };
        WijRadialGauge.prototype._paintMarkEle = function (opt) {
            var self = this, o = self.options, startLocation = {
                x: self.centerPoint.x - self.radius,
                y: self.centerPoint.y
            }, marker = opt.marker || "circle", baseLength = marker === "rect" ? 5 : 2, width = 2, length, strokeWidth = opt.style["stroke-width"] || 0;
            if(marker === "tri" || marker === "invertedTri") {
                baseLength = 5;
                width = 3;
            }
            if(marker === "cross") {
                opt.style.fill = opt.style.stroke || opt.style.fill;
            }
            if(isNaN(startLocation.x)) {
                startLocation.x = 0;
            }
            length = baseLength * opt.factor;
            width += strokeWidth * 2;
            length += strokeWidth * 2;
            if($.isFunction(marker)) {
                return marker.call(self, self.canvas, startLocation, o);
            } else {
                return wijmo.GaugeUtil.paintMarker(self.canvas, marker, startLocation.x, startLocation.y, length, width);
                if(marker === "tri") {
                    return self.canvas.isoTri(startLocation.x, startLocation.y, length, width, wijmo.Compass.west);
                } else if(marker === "invertedTri") {
                    return self.canvas.isoTri(startLocation.x, startLocation.y, length, width, wijmo.Compass.east);
                }
                return wijmo.GaugeUtil.paintMarker(self.canvas, marker, startLocation.x, startLocation.y, length, width, true);
            }
        };
        WijRadialGauge.prototype._setMarkValue = function (value, mark) {
            var self = this, angle = self._valueToAngle(value);
            //mark.rotate(angle, self.centerPoint.x, self.centerPoint.y);
            mark.transform(Raphael.format("r{0},{1},{2}...", angle, self.centerPoint.x, self.centerPoint.y));
        };
        WijRadialGauge.prototype._paintLabel = function (value, labelInfo) {
            var self = this, angle = self._valueToAngle(value), format = labelInfo.format, style = labelInfo.style, offset = labelInfo.offset, text = value.toString(), markOption = self.options.tickMajor, position = markOption.position || "inside", point, textEle, markBbox, newRadius, maxLabelBBox;
            if(format !== "") {
                text = wijmo.GaugeUtil.formatString(value, format);
            }
            markBbox = self._getMarkerBbox();
            maxLabelBBox = self._getLabelBBox(text);
            switch(position) {
                case "inside":
                    newRadius = markBbox.x + markBbox.width + maxLabelBBox.width / 2;
                    break;
                case "outside":
                    newRadius = markBbox.x - maxLabelBBox.width / 2;
                    break;
                default:
                    newRadius = markBbox.x - maxLabelBBox.width / 2;
                    break;
            }
            newRadius = self.centerPoint.x - newRadius + offset;
            point = wijmo.GaugeUtil.getPositionByAngle(self.centerPoint.x, self.centerPoint.y, newRadius, angle);
            textEle = self.canvas.text(point.x, point.y, text);
            textEle.attr(style);
            $.wijraphael.addClass($(textEle.node), self.options.wijCSS.radialGaugeLabel);
            return textEle;
        };
        WijRadialGauge.prototype._getLabelBBox = function (value) {
            var self = this, o = self.options, text, bbox;
            text = self.canvas.text(0, 0, value);
            text.attr(o.gaugeLableStyle);
            bbox = text.wijGetBBox();
            text.wijRemove();
            return bbox;
        };
        WijRadialGauge.prototype._getMarkerBbox = function () {
            var self = this, o = self.options, markOption = o.tickMajor, markEle;
            if(!self.markBbox) {
                markEle = self._paintMarkEle(markOption);
                self._applyAlignment(markEle, markOption.position, markOption.offset || 0);
                self.markBbox = markEle.wijGetBBox();
                markEle.wijRemove();
            }
            return self.markBbox;
        };
        WijRadialGauge.prototype._paintFace = function () {
            var self = this, o = self.options, r = Math.min(o.width, o.height) / 2, face, ui;
            if(self.faceRadius) {
                r = self.faceRadius;
            }
            if(o.face && o.face.template && $.isFunction(o.face.template)) {
                ui = {
                    canvas: self.canvas,
                    r: r,
                    origin: {
                        x: self.centerPoint.x,
                        y: self.centerPoint.y
                    }
                };
                return o.face.template.call(self, ui);
            }
            face = self.canvas.circle(self.centerPoint.x, self.centerPoint.y, r);
            if(o.face && o.face.style) {
                face.attr(o.face.style);
            }
            $.wijraphael.addClass($(face.node), o.wijCSS.radialGaugeFace);
            return face;
        };
        WijRadialGauge.prototype._paintPointer = function () {
            var self = this, o = self.options, pointerInfo = o.pointer, length = self.radius * pointerInfo.length, startLocation = {
                x: self.centerPoint.x - length + pointerInfo.offset * self.radius,
                y: self.centerPoint.y - pointerInfo.width / 2
            }, point;
            if(!pointerInfo.visible) {
                return;
            }
            if(o.cap && o.cap.behindPointer && o.cap.visible) {
                self._paintCap();
            }
            if(pointerInfo.template && $.isFunction(pointerInfo.template)) {
                point = pointerInfo.template.call(self.canvas, startLocation, $.extend({
                }, pointerInfo, {
                    length: length
                }));
            } else {
                if(pointerInfo.shape === "rect") {
                    point = self.canvas.rect(startLocation.x - pointerInfo.width / 2, startLocation.y, length, pointerInfo.width);
                } else {
                    point = self.canvas.isoTri(startLocation.x - pointerInfo.width / 2, startLocation.y, length, pointerInfo.width);
                }
                point.attr(pointerInfo.style);
            }
            self.pointer = point;
            $.wijraphael.addClass($(point.node), o.wijCSS.radialGaugePointer);
            if((!o.cap || !o.cap.behindPointer) && o.cap.visible) {
                self._paintCap();
            }
        };
        WijRadialGauge.prototype._paintCap = function () {
            var self = this, o = self.options, capInfo = o.cap, ui;
            if(capInfo && capInfo.template && $.isFunction(capInfo.template)) {
                ui = {
                    canvas: self.canvas,
                    origin: {
                        x: self.centerPoint.x,
                        y: self.centerPoint.y
                    }
                };
                self.cap = capInfo.template.call(self, ui);
                return self.cap;
            }
            self.cap = self.canvas.circle(self.centerPoint.x, self.centerPoint.y, capInfo.radius);
            if(capInfo && capInfo.style) {
                self.cap.attr(capInfo.style);
            }
            $.wijraphael.addClass($(self.cap.node), o.wijCSS.radialGaugeCap);
            return self.cap;
            //
                    };
        WijRadialGauge.prototype._paintRange = function (range) {
            var self = this, o = self.options, calculateFrom = isNaN(range.startValue) ? 0 : range.startValue, calculateTo = isNaN(range.endValue) ? 0 : range.endValue, calculateStartWidth = isNaN(range.startWidth) ? (isNaN(range.width) ? 0 : range.width) : range.startWidth, calculateEndWidth = isNaN(range.endWidth) ? (isNaN(range.width) ? 0 : range.width) : range.endWidth, startDistance = range.startDistance || 1, endDistance = range.endDistance || 1, coercedFrom, coercedTo;
            if(calculateFrom !== calculateTo) {
                if(calculateTo > calculateFrom) {
                    coercedFrom = Math.max(calculateFrom, o.min);
                    coercedTo = Math.min(o.max, calculateTo);
                } else {
                    coercedFrom = Math.max(o.min, calculateTo);
                    coercedTo = Math.min(o.max, calculateFrom);
                }
                startDistance = startDistance * self.radius;
                endDistance = endDistance * self.radius;
                self._drawRange(coercedFrom, coercedTo, startDistance, endDistance, calculateStartWidth, calculateEndWidth, range);
            }
        };
        WijRadialGauge.prototype._drawRange = function (from, to, startDistance, endDistance, startWidth, endWidth, range) {
            var self = this, startAngle = self._valueToAngle(from), endAngle = self._valueToAngle(to), outerPointers = self._generatePoints(startAngle, endAngle, startWidth + startDistance, endWidth + endDistance), innerPointers = self._generatePoints(startAngle, endAngle, startDistance, endDistance), i, rangeEl, path = "";
            $.each(outerPointers, function (i, n) {
                if(i === 0) {
                    path += "M" + Math.round(n.x + self.centerPoint.x) + " " + Math.round(n.y + self.centerPoint.y);
                } else {
                    path += "L" + (n.x + self.centerPoint.x) + " " + Math.round(n.y + self.centerPoint.y);
                }
            });
            for(i = innerPointers.length - 1; i >= 0; i--) {
                path += "L" + Math.round(innerPointers[i].x + self.centerPoint.x) + " " + Math.round(innerPointers[i].y + self.centerPoint.y);
            }
            path += "Z";
            rangeEl = self.canvas.path(path);
            rangeEl.attr(range.style);
            self.ranges.push(rangeEl);
            $.wijraphael.addClass($(rangeEl.node), self.options.wijCSS.radialGaugeRange);
        };
        WijRadialGauge.prototype._setOffPointerValue = function () {
            var self = this, angle = self._valueToAngle(0);
            //self.pointer.rotate(angle, self.centerPoint.x, self.centerPoint.y);
            self.pointer.transform(Raphael.format("r{0},{1},{2}", angle, self.centerPoint.x, self.centerPoint.y));
        };
        WijRadialGauge.prototype._setPointer = function () {
            var self = this, o = self.options, angle = self._valueToAngle(o.value), animation = o.animation;
            if(!self.pointer) {
                return;
            }
            _super.prototype._setPointer.call(this);
            if(animation.enabled) {
                self.pointer.stop().wijAnimate({
                    transform: "r" + angle + "," + self.centerPoint.x + "," + self.centerPoint.y
                }, animation.duration, animation.easing);
            } else {
                //self.pointer.rotate(angle, self.centerPoint.x, self.centerPoint.y);
                self.pointer.transform(Raphael.format("r{0},{1},{2}", angle, self.centerPoint.x, self.centerPoint.y));
            }
        };
        return WijRadialGauge;
    })(wijmo.WijmoGauge);
    wijmo.WijRadialGauge = WijRadialGauge;    
    WijRadialGauge.prototype.widgetEventPrefix = "wijradialgauge";
    WijRadialGauge.prototype.options = $.extend(true, {
    }, wijmo.WijmoGauge.prototype.options, {
        initSelector: ":jqmData(role='wijradialgauge')",
        wijCSS: {
            radialGauge: "wijmo-wijradialgauge",
            radialGaugeLabel: "wijmo-wijradialgauge-label",
            radialGaugeMarker: "wijmo-wijradialgauge-mark",
            radialGaugeFace: "wijmo-wijradialgauge-face",
            radialGaugePointer: "wijmo-wijradialgauge-pointer",
            radialGaugeCap: "wijmo-wijradialgauge-cap",
            radialGaugeRange: "wijmo-wijradialgauge-range"
        },
        radius: /// <summary>
        /// A value that indicates the radius of the radial gauge.
        /// Default: "auto".
        /// Type: Number.
        /// Code example: $("#selector").wijradialgauge("option", "radius", 170).
        /// </summary>
        "auto",
        startAngle: /// <summary>
        /// A value that indicates the start angle of the radial gauge.
        /// Default: 0
        /// Type: Number
        /// Code example: $("#selector").wijradialgauge("option", "startAngle", -20).
        /// </summary>
        0,
        sweepAngle: /// <summary>
        /// A value that indicates the sweep angle of the radial gauge.
        /// Default: 180.
        /// Type: Number.
        /// Code example: $("#selector").wijradialgauge("option", "sweepAngle", 200).
        /// </summary>
        180,
        pointer: /// <summary>
        /// Set the pointer of the gauge.
        /// Default: false.
        /// Type: Boolean.
        /// Code example: $("#element").wijradialgauge( { pointer: {} } );
        /// </summary>
        {
            length: 0.8,
            style: {
                fill: "#1E395B",
                stroke: "#1E395B"
            },
            width: 8,
            offset: 0.15
        },
        origin: /// <summary>
        /// A point that indicates the origin of the radial gauge.
        /// Default: { x: 0.5, y: 0.5 }.
        /// Type: Object
        /// Code example: $("#selector").wijradialgauge("option",
        /// "origin", { x: 0.5, y: 0.6 }).
        /// </summary>
        {
            x: 0.5,
            y: 0.5
        },
        labels: /// <summary>
        /// A value that includes all settings of the gauge label.
        /// Default: {format: "", style: {fill: "#1E395B", "font-size": "12pt",
        /// "font-weight": "800"}, visible: true, offset: 30}.
        /// Type: Object.
        /// $("#selector").wijradialgauge("option", "labels", {visible: false}).
        /// </summary>
        {
            style: /// <summary>
            /// A value that indicates the style of the gauge label.
            /// Default: {fill: "#1E395B", "font-size": 12, "font-weight": "800"}.
            /// Type: Object.
            /// </summary>
            {
                fill: "#1E395B",
                "font-size": 12,
                "font-weight": "800"
            },
            offset: /// <summary>
            /// A value that indicates the position of the gauge label.
            /// Type: Number.
            /// Default: 30.
            /// </summary>
            30
        },
        tickMinor: /// <summary>
        /// A value that provides information for the major tick.
        /// Default: {position: "inside", style: { fill: "#1E395B", stroke:"none"
        /// }, factor: 1, visible: true, marker: "rect", offset: 30, interval: 5}
        /// Type: Object.
        /// Code example: $("#selector").wijradialgauge("option",
        /// "tickMinor", {interval: 2}).
        /// </summary>
        {
            position: /// <summary>
            /// A value that indicates the type of major tick mark.
            /// Default: "inside".
            /// Type: "String"
            /// remarks: Options are 'inside', 'outside' and 'cross'.
            /// </summary>
            "inside",
            offset: /// <summary>
            /// A value that indicates where to paint the tick on the gauge.
            /// Default: 30.
            /// Type: Number.
            /// </summary>
            30,
            style: /// <summary>
            /// A value that indicates the style of major tick mark.
            /// Default: {fill: "#1E395B"}.
            /// Type: Object.
            /// </summary>
            {
                fill: "#1E395B"
            },
            visible: /// <summary>
            /// A value that indicates whether show the major tick.
            /// Default: true.
            /// Type: Boolean.
            /// </summary>
            true
        },
        tickMajor: /// <summary>
        /// A value that provides information for the minor tick.
        /// Default: {position: "inside", style: { fill: "#1E395B",
        /// stroke: "#1E395B", "stroke-width": "1"
        /// }, factor: 2, visible: true, marker: "rect", offset: 27, interval: 10}.
        /// Type: Object.
        /// code example: $("#selector").wijradialgauge("option",
        /// "tickMajor", {interval: 15}).
        /// </summary>
        {
            position: /// <summary>
            /// A value that indicates the type of minor tick mark.
            /// Default: "inside".
            /// Type: "String"
            /// remarks: Options are 'inside', 'outside' and 'cross'.
            /// </summary>
            "inside",
            offset: /// <summary>
            /// A value that indicates where to paint the tick on the gauge.
            /// Default: 27.
            /// Type: Number.
            /// </summary>
            27,
            style: /// <summary>
            /// A value that indicates the style of minor tick mark.
            /// Default: {fill: "#1E395B", stroke: "#1E395B", "stroke-width": 1}.
            /// Type: Object.
            /// </summary>
            {
                fill: "#1E395B",
                stroke: "#1E395B",
                "stroke-width": 1
            },
            visible: /// <summary>
            /// A value that indicates whether show the minor tick.
            /// Type: Boolean.
            /// Default: true.
            /// </summary>
            true
        },
        cap: /// <summary>
        /// A value that includes all settings of the pointer cap of the gauge.
        /// Default: { radius: 15, style: {fill: "#1E395B", stroke: "#1E395B"},
        /// behindPointer: false, visible: true, template: null }.
        /// Type: Object.
        /// Code example: Code example: $("#selector").wijradialgauge("option",
        /// "cap", {radius: 20}).
        /// </summary>
        {
            radius: /// <summary>
            /// A value that indicates the radius of the cap.
            /// Default: 15
            /// Type: Number
            /// </summary>
            15,
            style: /// <summary>
            /// A value that indicates the style of the cap.
            /// Default: {fill: "#1E395B", stroke: "#1E395B"}.
            /// Type: Object.
            /// </summary>
            {
                fill: "#1E395B",
                stroke: "#1E395B"
            },
            behindPointer: /// <summary>
            /// A value that indicates whether the cap showing behind of the pointer.
            /// Default: false.
            /// Type: Boolean.
            /// </summary>
            false,
            visible: /// <summary>
            /// A value that indicates whether draw the cap.
            /// Default: true.
            /// Type: Boolean.
            /// </summary>
            true,
            template: /// <summary>
            /// A function that indicates how to draw the pointer cap.
            /// If user want to customize the cap, they can use this option.
            /// Default: null.
            /// Type: Function
            /// </summary>
            null
        },
        face: /// <summary>
        /// A value that indicates the style of the gauge face.
        /// Default: {fill: ""r(0.9, 0.60)#FFFFFF-#D9E3F0"", stroke: "#7BA0CC",
        /// "stroke-width": "4"}, template: null}.
        /// Type: Object.
        /// Code example: $("#selector").wijradialgauge("option",
        /// "face", {style: {fill: "#000555"}}).
        /// </summary>
        {
            style: /// <summary>
            /// A value that indicates the style of the gauge face.
            /// Default: {fill: ""r(0.9, 0.60)#FFFFFF-#D9E3F0"",
            /// stroke: "#7BA0CC", "stroke-width": 4}.
            /// Type: Object.
            /// </summary>
            {
                fill: "r(0.9, 0.60)#FFFFFF-#D9E3F0",
                stroke: "#7BA0CC",
                "stroke-width": 4
            }
        }
    });
    //$.widget("wijmo.wijradialgauge", WijRadialGauge.prototype);
    $.wijmo.registerWidget("wijradialgauge", WijRadialGauge.prototype);
})(wijmo || (wijmo = {}));
