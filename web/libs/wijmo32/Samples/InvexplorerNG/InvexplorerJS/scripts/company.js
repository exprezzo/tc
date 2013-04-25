var Company = (function () {
    function Company(viewModel, symbol, name) {
        this.prices = [];
        this.chartSeries = [];
        this.viewModel = viewModel;
        this.symbol = symbol;
        this.name = name;
    }
    Company.prototype.updatePrices = function () {
        var self = this;
        if(self.prices.length == 0) {
            var vm = self.viewModel;
            vm.updating++;
            $.get("StockInfo.ashx?symbol=" + self.symbol, function (result) {
                vm.updating--;
                var newPrices = [];
                var lines = result.split("\r");
                for(var i = 0; i < lines.length; i++) {
                    var items = lines[i].split("\t");
                    if(items.length == 2) {
                        var day = new Date($.trim(items[0]).replace(/-/g, "/"));
                        var price = $.trim(items[1]) * 1;
                        newPrices.push(new ItemPrice(day, price));
                    }
                }
                self.prices = newPrices;
                self.viewModel.updateView();
            });
        }
    };
    Company.prototype.getChartSeries = function () {
        var xData = [];
        var yData = [];

        var prices = this.prices;
        for(var i = 0; i < prices.length; i++) {
            if(prices[i].day < this.viewModel.minDate) {
                break;
            }
            xData.push(prices[i].day);
            yData.push(prices[i].price);
        }
        if(xData.length == 0) {
            xData.push(0);
            yData.push(0);
        }
        var baseValue = yData[yData.length - 1];
        for(var i = 0; i < yData.length; i++) {
            yData[i] = yData[i] / baseValue - 1;
        }
        var series = {
            data: {
                x: xData,
                y: yData
            },
            label: this.symbol,
            legendEntry: false,
            markers: {
                visible: false
            }
        };
        return series;
    };
    return Company;
})();
var ItemPrice = (function () {
    function ItemPrice(day, price) {
        this.day = day;
        this.price = price;
    }
    return ItemPrice;
})();
