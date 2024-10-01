@extends('layouts.app')

@section('head')
<script src="https://cdn.cinetpay.com/seamless/main.js"></script>
@endsection

@section('content')
<div class="container mx-auto px-2 py-8">
    <h1 class="text-4xl font-bold mb-8 text-center text-blue-600">Faire un don aux Journées Sahel Digital</h1>

    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <!-- Image à gauche (en haut sur mobile) -->
            <div class="md:w-1/2">
                <img src="{{ asset('images/donate-desktop.png') }}" alt="Faire un don" class="w-full h-full object-cover hidden md:block">
                <img src="{{ asset('images/donate-image-mobile.png') }}" alt="Faire un don" class="w-full h-64 object-cover md:hidden">
            </div>

            <!-- Formulaire à droite -->
            <div class="md:w-1/2 p-8">
                <p class="mb-6 text-gray-700">
                    Votre soutien est crucial pour le succès des Journées Sahel Digital. Chaque don contribue à promouvoir l'innovation et l'entrepreneuriat numérique dans la région du Sahel.
                </p>

                <form id="donationForm" class="space-y-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Montant de don (en FCFA)</label>
                <div class="donation-input-container w-full">
                    <div class="amount-container">
                       <input type="number" id="amount" name="amount" min="100" value="1000" class="amount-input w-full">
                    </div>
                    <div class="currency-container">
                        <span class="currency-text">FCFA</span>
                    </div>
                </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <button type="button" onclick="checkout()" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                            Faire un don
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function checkout() {
    const amount = document.getElementById('amount').value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;

    CinetPay.setConfig({
        apikey: '92739355766a1889cb6f581.56249806',  // Remplacez par votre APIKEY
        site_id: '5880592',  // Remplacez par votre SITE_ID
        notify_url: 'http://mondomaine.com/notify/',
        mode: 'PRODUCTION'
    });
    CinetPay.getCheckout({
        transaction_id: Math.floor(Math.random() * 100000000).toString(),
        amount: parseInt(amount),
        currency: 'XAF',
        channels: 'ALL',
        description: 'Don pour les Journées Sahel Digital',
        customer_name: name,
        customer_email: email,
        customer_phone_number: "",
        customer_address : "",
        customer_city: "",
        customer_country : "CM",
        customer_state : "CM",
        customer_zip_code : "",
    });
    CinetPay.waitResponse(function(data) {
        if (data.status == "REFUSED") {
            alert("Votre paiement a échoué. Veuillez réessayer.");
        } else if (data.status == "ACCEPTED") {
            alert("Merci pour votre don ! Votre paiement a été effectué avec succès!");
        }
    });
    CinetPay.onError(function(data) {
        console.log(data);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    });
}
</script>
@endsection
