///<reference path='portfolio.ts'/>
///<reference path='company.ts'/>

// declare externally defined objects (to keep TypeScript compiler happy)
declare var $;
declare var Globalize;

/***********************************************************************************
* PortfolioItem class.
*/
class PortfolioItem {

    // fields
    portfolio: Portfolio;
    symbol: string;
    company: Company;
    lastPrice = 0;
    change = 0;
    chart = false;
    shares = 0;
    unitCost = 0;

    constructor (portfolio: Portfolio, symbol: string, chart = false, shares = 0, unitCost = 0)    {
        this.portfolio = portfolio;
        this.symbol = symbol;

        // editable values
        this.chart = chart;
        this.shares = shares;
        this.unitCost = unitCost;

		// update chart when 'chart' property changes
		// REVIEW: this is not working. why?
		//this.portfolio.viewModel.scope.$watch('chart', function() {  
		//	alert("chart changed watch");
		//	this.portfolio.viewModel.updateView();
		//});

        // find company
        this.company = portfolio.viewModel.findCompany(symbol);
        if (this.company != null) {
            this.company.updatePrices();
        }
    }

	// to update chart when 'chart' property changes
	public chartChanged() {
		this.portfolio.viewModel.updateView();
	}

    // remove this item from the portfolio
    public remove() {
        this.portfolio.removeItem(this);
    }

    // computed observables
    public getValue() : any {
        var value = this.lastPrice * this.shares;
        if (value == 0) return "";
        return value;
    }
    public getCost(): any {
        var cost = this.unitCost * this.shares; 
        if (cost == 0) return "";
        return cost;
    }
    public getChangePercent(): any {
        if (this.change == 0 || this.lastPrice == 0)  return "";
        return this.change / this.lastPrice * 100;
    }
    public getGain(): any {
        var value = this.lastPrice * this.shares;
        var cost = this.unitCost * this.shares; 
        if (cost == 0 || value == 0) return "";
        return value - cost;
    }
    public getGainPercent(): any {
        var value = this.lastPrice * this.shares;
        var cost = this.unitCost * this.shares; 
        if (cost == 0 || value == 0) return "";
        return (value - cost) / cost * 100;
    }
    public getColor() : string {
        var palette = ViewModel.palette;
        var index = this.portfolio.items.indexOf(this);
        return index > -1 ? palette[index % palette.length] : "black";
    }
    public getAmountColor(amount : number) : string {
		return amount < -0.01 ? "#D84874" : amount > +0.01 ? "#279972" : "black";
	}
    public getRowColor() : string {
        return this.chart ? "#fcfcf0" : "transparent";
    }

    // update chart data when prices array changes
    updatePrices() {
        if (this.company != null) {
            var prices = this.company.prices;
            if (prices.length > 1) {
                this.lastPrice = prices[0].price;
                this.change = prices[0].price - prices[1].price;
            }
        }
    }
}
