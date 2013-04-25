var PortfolioItem = (function () {
    function PortfolioItem(portfolio, symbol, chart, shares, unitCost) {
        if (typeof chart === "undefined") { chart = false; }
        if (typeof shares === "undefined") { shares = 0; }
        if (typeof unitCost === "undefined") { unitCost = 0; }
        this.lastPrice = 0;
        this.change = 0;
        this.chart = false;
        this.shares = 0;
        this.unitCost = 0;
        this.portfolio = portfolio;
        this.symbol = symbol;
        this.chart = chart;
        this.shares = shares;
        this.unitCost = unitCost;
        this.company = portfolio.viewModel.findCompany(symbol);
        if(this.company != null) {
            this.company.updatePrices();
        }
    }
    PortfolioItem.prototype.chartChanged = function () {
        this.portfolio.viewModel.updateView();
    };
    PortfolioItem.prototype.remove = function () {
        this.portfolio.removeItem(this);
    };
    PortfolioItem.prototype.getValue = function () {
        var value = this.lastPrice * this.shares;
        if(value == 0) {
            return "";
        }
        return value;
    };
    PortfolioItem.prototype.getCost = function () {
        var cost = this.unitCost * this.shares;
        if(cost == 0) {
            return "";
        }
        return cost;
    };
    PortfolioItem.prototype.getChangePercent = function () {
        if(this.change == 0 || this.lastPrice == 0) {
            return "";
        }
        return this.change / this.lastPrice * 100;
    };
    PortfolioItem.prototype.getGain = function () {
        var value = this.lastPrice * this.shares;
        var cost = this.unitCost * this.shares;
        if(cost == 0 || value == 0) {
            return "";
        }
        return value - cost;
    };
    PortfolioItem.prototype.getGainPercent = function () {
        var value = this.lastPrice * this.shares;
        var cost = this.unitCost * this.shares;
        if(cost == 0 || value == 0) {
            return "";
        }
        return (value - cost) / cost * 100;
    };
    PortfolioItem.prototype.getColor = function () {
        var palette = ViewModel.palette;
        var index = this.portfolio.items.indexOf(this);
        return index > -1 ? palette[index % palette.length] : "black";
    };
    PortfolioItem.prototype.getAmountColor = function (amount) {
        return amount < -0.01 ? "#D84874" : amount > 0.01 ? "#279972" : "black";
    };
    PortfolioItem.prototype.getRowColor = function () {
        return this.chart ? "#fcfcf0" : "transparent";
    };
    PortfolioItem.prototype.updatePrices = function () {
        if(this.company != null) {
            var prices = this.company.prices;
            if(prices.length > 1) {
                this.lastPrice = prices[0].price;
                this.change = prices[0].price - prices[1].price;
            }
        }
    };
    return PortfolioItem;
})();
