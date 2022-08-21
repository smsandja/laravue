@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center bg-white">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color:#3a9ef0">Historique des commandes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="lead">
                        <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}" role="button">Retourner à la boutique</a>
                    </p>
                    @foreach (Auth()->user()->orders as $order)
                        <div class="card mb-3">
                            <div class="card-header" style="background-color:#78b9ee">
                                Commande passée le {{ Carbon\Carbon::parse($order->payment_created_at)->format('d/m/Y à H:i')}} d'un montant total de <strong>{{ getPrice($order->amount) }}</strong>, réduction et taxe comprise
                            </div>
                            <div class="card-body">
                                <h6>Liste des produits</h6>
                                @foreach (unserialize($order->products) as $product)
                                    <div>Nom du produit: {{ $product[0] }}</div>
                                    <div>Prix: {{ ($product[1]) }}</div>
                                    <div>Quantité: {{ $product[2] }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
