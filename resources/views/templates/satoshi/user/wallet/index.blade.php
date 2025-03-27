@extends($activeTemplate . 'layouts.app')
@section('panel')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
      <div class="row row__bscreen">

        <section>
          <div class="custom-containers">
            <div class="title">
              <h2>Wallet Portfolio</h2>
              <a href="#"></a>
            </div>
      
            <div class="row gy-3">
              @foreach($coins as $data)
              <div class="col-12">
                <div class="transaction-box">
                  <a href="{{route('user.crypto.wallet',encrypt($data->id))}}" class="d-flex gap-3">
                    <div class="transaction-image color1">
                      <img class="img-fluid icon" src="{{url('/')}}/assets/images/coins/{{$data->image}}" alt="bitcoins" />
                    </div>
                    <div class="transaction-details">
                      <div class="transaction-name">
                        <h5> {{$data->name}}</h5>
                        <h3 id="{{$data->symbol}}"><i class="fa fa-spinner fa-spin"></i></h3>
                      </div>
                      <div class="d-flex justify-content-between">
                        <h5 class="light-text"> {{$data->symbol}}</h5>
                        <h5 id="{{$data->symbol}}percent" ><i class="fa fa-spinner fa-spin"></i></h5>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              @endforeach
               
            </div>
          </div>
        </section>
        <!-- Transaction section end -->

        
        
      </div>
    </div>
  </section>
  <!-- End crancy Dashboard -->
 
@endsection



@push('script')
<script>
    const priceElement = document.querySelectorAll(".price")
    const percentElement = document.querySelectorAll(".percent")
    
    let btcBalance = document.querySelector("#btc-balance")
    let ethBalance = document.querySelector("#eth-balance")
    let bchBalance = document.querySelector("#bch-balance")
    let ltcBalance = document.querySelector("#ltc-balance")
    let usdcBalance = document.querySelector("#usdc-balance")
    let xrpBalance = document.querySelector("#xrp-balance")
    
    const coins = async () => {
        await fetch('https://data.messari.io/api/v1/assets')
        .then(data => data.json())
        .then(res => {
            res.data.map(coin => {
                let coinPrice = coin.metrics.market_data.price_usd
                let coinPercent = coin.metrics.market_data.percent_change_usd_last_24_hours
                var newBalance
                switch (coin.symbol) {
                    case "BTC":
                        document.getElementById("BTC").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("BTCpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("BTCpercent").style.color = "green"
                        }
                        document.getElementById("BTCpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        break;
                    case "ETH":
                         document.getElementById("ETH").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("ETHpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("ETHpercent").style.color = "green"
                        }
                        document.getElementById("ETHpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "USDT":
                        document.getElementById("USDTERC20").innerHTML = `$${coinPrice.toFixed(0) } `
                        document.getElementById("TCN").innerHTML = `$${coinPrice.toFixed(0) } ` 
     
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("USDTERC20percent").style.color = "red"
                            document.getElementById("TCNpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("USDTERC20percent").style.color = "green"
                            document.getElementById("TCNpercent").style.color = "green"
                        }
                        document.getElementById("USDTERC20percent").innerHTML = `${coinPercent.toFixed(2)}%`
                        document.getElementById("TCNpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "BCH":
                         document.getElementById("BCH").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("BCHpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("BCHpercent").style.color = "green"
                        }
                        document.getElementById("BCHpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "LTC":
                         document.getElementById("LTC").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("LTCpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("LTCpercent").style.color = "green"
                        }
                        document.getElementById("LTCpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                    break;
    
                    case "BNB":
                         document.getElementById("BNB").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("BNBpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("BNBpercent").style.color = "green"
                        }
                        document.getElementById("BNBpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "XRP":
                         document.getElementById("DASH").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("DASHpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("DASHpercent").style.color = "green"
                        }
                        document.getElementById("DASHpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "DOGE":
                         document.getElementById("DOGE").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("DOGEpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("DOGEpercent").style.color = "green"
                        }
                        document.getElementById("DOGEpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
                    
    
                    default:
                        break;
                }
            })
        })
    }
    
    coins()
</script>
@endpush
