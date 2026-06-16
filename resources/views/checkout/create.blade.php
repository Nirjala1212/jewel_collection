<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f5f1eb] min-h-screen">

<div class="max-w-7xl mx-auto px-6 py-8">

    <a href="{{ route('cart.index') }}"
       class="inline-block bg-black text-white px-6 py-3 rounded-full font-bold mb-6 hover:bg-gray-800">
        ← Back to Cart
    </a>

    <h1 class="text-4xl font-bold text-center mb-8">Checkout</h1>
      @if(session('error'))
    <div class="bg-red-100 text-red-700 px-6 py-4 rounded-xl mb-6 font-semibold">
        {{ session('error') }}
    </div>
  @endif

  @if(session('success'))
    <div class="bg-green-100 text-green-700 px-6 py-4 rounded-xl mb-6 font-semibold">
        {{ session('success') }}
    </div>
@endif

    @if($cartItems->count() > 0)

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-8">

                <h2 class="text-2xl font-bold mb-1">Delivery Information</h2>
                <p class="text-gray-500 mb-6">Fill in your address for fast delivery.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="font-semibold">Full Name</label>
                        <input type="text" name="full_name" required
                               class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black"
                               placeholder="Enter full name">
                    </div>

                    <div>
                        <label class="font-semibold">Phone Number</label>
                        <input type="text" name="phone" required
                               class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black"
                               placeholder="98XXXXXXXX">
                    </div>
                           <div>
    <label class="block font-semibold mb-2">
        Email Address
    </label>

    <input type="email"
           name="email"
           value="{{ old('email', auth()->user()->email ?? '') }}"
           class="w-full border rounded-xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-black"
           placeholder="Enter your email"
           required>
</div>
                    <div>
                        <label class="font-semibold">Province</label>
                        <select id="province" name="province" required
                                class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black">
                            <option value="">Select Province</option>
                            <option value="Koshi">Koshi</option>
                            <option value="Madhesh">Madhesh</option>
                            <option value="Bagmati">Bagmati</option>
                            <option value="Gandaki">Gandaki</option>
                            <option value="Lumbini">Lumbini</option>
                            <option value="Karnali">Karnali</option>
                            <option value="Sudurpashchim">Sudurpashchim</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-semibold">City</label>
                        <select id="city" name="city" required
                                class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black">
                            <option value="">Select City</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-semibold">Area</label>
                        <select id="area" name="area" required
                                class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black">
                            <option value="">Select Area</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-semibold">Landmark</label>
                        <input type="text" name="landmark"
                               class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black"
                               placeholder="Near school, mall, temple">
                    </div>

                </div>

                <div class="mt-5">
                    <label class="font-semibold">Street Address</label>
                    <input type="text" name="delivery_address" required
                           class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black"
                           placeholder="House no, street, building, floor">
                </div>

                <div class="mt-5">
                    <label class="font-semibold">Payment Method</label>
                    <select name="payment_method" required
                            class="w-full mt-2 p-4 border rounded-xl focus:outline-none focus:ring-2 focus:ring-black">
                        <option value="">Select Payment Method</option>
                        <option value="COD">Cash on Delivery</option>
                        <option value="ESEWA">Esewa</option>
                    </select>
                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-7 sticky top-6">

                <h2 class="text-2xl font-bold mb-5">Order Summary</h2>

                @foreach($cartItems as $item)
                    <div class="flex justify-between gap-4 border-b py-4">
                        <div>
                            <p class="font-bold">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>

                        <p class="font-bold whitespace-nowrap">
   Rs. {{ number_format($item->product->final_price * $item->quantity) }}                    </div>
                @endforeach

                <div class="flex justify-between mt-6 text-xl font-bold">
                    <span>Total</span>
                    <span>Rs. {{ number_format($total) }}</span>
                </div>

                <button type="submit"
                        class="w-full mt-6 bg-black text-white py-4 rounded-xl font-bold text-lg hover:bg-yellow-500 hover:text-black transition">
                    Place Order
                </button>

            </div>

        </div>
    </form>

    @else

        <div class="bg-white rounded-2xl shadow-xl p-10 text-center">
            <h2 class="text-2xl font-bold">Your cart is empty.</h2>
        </div>

    @endif

</div>

<script>
const cityData = {
    "Koshi": ["Biratnagar", "Dharan", "Itahari"],
    "Madhesh": ["Janakpur", "Birgunj"],
    "Bagmati": ["Kathmandu", "Lalitpur", "Bhaktapur"],
    "Gandaki": ["Pokhara"],
    "Lumbini": ["Butwal", "Bhairahawa"],
    "Karnali": ["Surkhet"],
    "Sudurpashchim": ["Dhangadhi"]
};

const areaData = {
    "Kathmandu": ["Baneshwor", "Koteshwor", "Kalanki", "Balaju", "New Road"],
    "Lalitpur": ["Jawalakhel", "Satdobato", "Kupondole"],
    "Bhaktapur": ["Suryabinayak", "Thimi"],
    "Pokhara": ["Lakeside", "Mahendrapool"],
    "Biratnagar": ["Traffic Chowk", "Main Road"],
    "Dharan": ["Putali Line", "Bhanu Chowk"],
    "Itahari": ["Itahari Chowk", "Tarahara", "Khanar", "Aaitabare"],
    "Butwal": ["Golpark", "Traffic Chowk"],
    "Bhairahawa": ["Bus Park"],
    "Janakpur": ["Janak Chowk"],
    "Birgunj": ["Ghantaghar"],
    "Surkhet": ["Birendranagar"],
    "Dhangadhi": ["Main Market"]
};

const province = document.getElementById('province');
const city = document.getElementById('city');
const area = document.getElementById('area');

function loadCities(selectedCity = "") {
    city.innerHTML = '<option value="">Select City</option>';
    area.innerHTML = '<option value="">Select Area</option>';

    let cities = cityData[province.value] || [];

    cities.forEach(function (item) {
        let selected = item === selectedCity ? 'selected' : '';
        city.innerHTML += `<option value="${item}" ${selected}>${item}</option>`;
    });
}

function loadAreas(selectedArea = "") {
    area.innerHTML = '<option value="">Select Area</option>';

    let areas = areaData[city.value] || [];

    areas.forEach(function (item) {
        let selected = item === selectedArea ? 'selected' : '';
        area.innerHTML += `<option value="${item}" ${selected}>${item}</option>`;
    });
}

province.addEventListener('change', function () {
    loadCities();
});

city.addEventListener('change', function () {
    loadAreas();
});

loadCities();

@if(old('city'))
    city.value = "{{ old('city') }}";
    loadAreas("{{ old('area') }}");
@endif
</script>
</body>
</html>