
      @extends('layouts.master')

      @section('extra-meta')
      <meta name="csrf-token" content="{{ csrf_token() }}">
      @endsection
      
      @section('content') 
      <h2 class="text-dark-bold">Mon panier</h2>
          @if (Cart::count() > 0)
         
          <div class="px-4 px-lg-0">
              <div class="pb-5">
                  <div class="container"> 
                      <div class="row">
                          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5"> 
                      
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th scope="col" class="border-0 bg-light"> 
                                              <div class="p-2 px-3 text-uppercase"> Produit</div>
                                          </th>
                                          <th scope="col" class="border-0 bg-light"> 
                                              <div class="py-2 text-uppercase"> Prix</div>
                                          </th>
                                          <th scope="col" class="border-0 bg-light"> 
                                              <div class="py-2 text-uppercase"> Quantité</div>
                                          </th>
                                          <th scope="col" class="border-0 bg-light"> 
                                              <div class="py-2 text-uppercase"> Supprimer</div>
                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach (Cart::content() as $product)
                                          <tr>
                                              <th scope="row" class="border-0">
                                                 <div class="p-2">
                                                 <img src="{{ $product->model->image }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                  <div class="cl-3 d-inline-block align-middle">
                                                  <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{ $product->model->title }}</a></h5> <span class="text-muted font-weight-normal font-italic d-block"> Category:</span>
                                                  </div>
                                                  </div>   
                                              </th>
                                          <td class="border-0 align-middle"><strong>{{ getPrice($product->subtotal()) }}</strong></td>
                                          <td class="border-0 align-middle">
                                            <select name="qty" id="qty" data-id="{{ $product->rowId }}" class="custom-select" >
                                              @for ($i = 1; $i <= 5; $i++)
                                              <option value="{{ $i }}" {{ $i == $product->qty ? 'selected' : ''}} >
                                                {{ $i }}
                                              </option>
                                              @endfor
                                            </select>
                                          </td>
                                          <td class="border-0 align-middle">
                                               <form action=" {{ route('cart.destroy', $product->rowId)}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                              </form>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                           <!-- End -->
                    </div>
                  </div>
            
                  <div class="row py-5 p-4 bg-white rounded shadow-sm">
                    <div class="col-lg-6">
                      <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                      <div class="p-4">
                        <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                        <div class="input-group mb-4 border rounded-pill p-2">
                          <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
                          <div class="input-group-append border-0">
                            <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
                          </div>
                        </div>
                      </div>
                      <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
                      <div class="p-4">
                        <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
                        <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Détails de la commande </div>
                      <div class="p-4">
                        <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
                        <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous Total </strong><strong>{{ getPrice(Cart::subtotal() )}}</strong></li>
                          {{-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
       --}}
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Taxe</strong><strong>{{ getPrice(Cart ::tax() )}}</strong></li>
                          <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                          <h5 class="font-weight-bold"> {{ getPrice(Cart::total())}}</h5>
                          </li>
                        </ul><a href="{{ route('checkout.index') }}" class="btn btn-dark rounded-pill py-2 btn-block">Passer à la caisse</a>
                      </div>
                    </div>
                  </div>
            
                </div>
              </div>
            </div>     
          @else
          <div class="col-md-12">
               <h5>Votre panier est vide pour le moment.</h5>
               <p>Mais vous pouvez visiter la <a href="{{ route('products.index') }}">boutique</a> pour faire votre shopping.</p>
          </div>
          @endif
      @endsection
      
      @section('extra-js')
      <script>
        var selects = document.querySelectorAll('#qty');
        Array.from(selects).forEach((element) => { 
          element.addEventListener('change', function () {
            var rowId = this.getAttribute('data-id');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch( 
                   `/panier/${rowId}`,
              { 
                headers: {
                  "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'patch',
                    body: JSON.stringify({
                      qty: this.value
                    })
                }).then((data) => {
                  console.log(data);
                  location.reload();
      
                }).catch((error) => {
                  console.log(error);
                }) 
          });
        });
      </script>
      @endsection


        
        $intent = paymentIntent::create([
            'amount' => round(Cart::total()/655),
            'currency' => 'eur',
        ]);

        $clientSecret = Arr::get($intent, 'client_secret');

        return view('checkout.index', [
            'clientSecret' => $clientSecret
        ]);
@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="[{ csrf_token() }]">
@endsection

@section('content')
    <div class="col-md-12">
        <h1>Page de paiement</h1>
        <div class="row">
            <div class="col-md-6">
            <form action="{{ route('checkout.store')}}" method="POST" class="my-4" id="payment-form">
                    <div id="card-element">
                        @csrf
                    <!-- Elements will create input elements here -->
                    </div>

                    <!-- We'll put the error messages in this element -->
                    <div id="card-errors" role="alert"></div>
{{-- pk_test_51KSNETEsNu5YXx77KbRBQMHZowTopu8OsrT06wpnqaUXMa84aEAKWMPPE3w580xwJAoljMnOtxxmZIgsujuq7oCj00PPpQKhjH
    sk_test_51KSNETEsNu5YXx77xQBorDBxry3eHPfjZ98gTT8rmZ5bkrfQv07O2SQQFLX5Ws2qfml2jVR0Q1mJ0wmCSTbFnISt00JG1qX343
    
    --}}
                    <button class="btn btn-success mt-3" id="submit">Payer maintenant ({{ getPrice(Cart::total())}})</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<script>
    var stripe =  Stripe('pk_test_51KSNETEsNu5YXx77KbRBQMHZowTopu8OsrT06wpnqaUXMa84aEAKWMPPE3w580xwJAoljMnOtxxmZIgsujuq7oCj00PPpQKhjH');
    var elements = stripe.elements();
    var style = {
        base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
        },
        invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
        }
    };
    var card = elements.create("card", { style: style });
    card.mount("#card-element");
    card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.classList.add('alert', 'alert-warning', 'mt-3');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('alert', 'alert-warning', 'mt-3');
            displayError.textContent = '';
        }
    });
    var submitButton = document.getElementById('submit');
     
    submitButton.addEventListener('click', function(ev) {
    ev.preventDefault();
    submitButton.disabled = true; 
    stripe.confirmCardPayment("{{ $clientSecret }}", {
        payment_method: {
            card: card
        }
        }).then(function(result) {
            if (result.error) {
                submitButton.disabled = true; 
            // Show error to your customer (e.g., insufficient funds)
            console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    var paymentIntent = result.paymentIntent;
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var form = document.getElementById('payment-form');
                    var url = form.action;
                    var redirect ='/merci'; 

                    fetch(
                        url,
                        {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'post',
                            body: JSON.stringify({
                                paymentIntent: paymentIntent
                            })

                        }
                        ).then((data) => {
                            if (data.status === 400) {
                                var redirect = '/boutique';
                            } else {
                                var redirect = '/merci';
                            }
                }
            }
        });
    });
</script>
@endsection