<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ad Listings</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h1 class="text-3xl font-bold mb-6">Ad Listings</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif


        <form method="POST" action="{{ route('ads.refresh') }}">
            @csrf
            <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mb-4 text-xl text-white">
                🔄 Refresh Data
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full auto border-collapse border border-gray-300 responsive-table">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border">App</th>
                        <th class="px-4 py-2 border">Payout</th>
                        <th class="px-4 py-2 border">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads as $ad)
                        <tr>
                            <td class="border px-4 py-2">
                                
                                @if($ad->creatives_url)
                                <a href="{{$ad->click_url}}" target="_blank">
                                    <img src="{{ $ad->creatives_url }}" alt="Ad Image" class="object-cover min-w-50" width="200" height="200">
                                    </a>
                                @endif
                            </td>
                            <td class="border px-4 py-2"><strong>${{ number_format($ad->price, 2) }}&nbsp;{{$ad->payout_currency}}</strong></td>
                            <td class="border px-4 py-2">
                            <p class="text-2xl font-bold">{{ $ad->name }}</p>
                            <p class="text-xl my-2">{{ $ad->kpi }}</p>
                                {!! $ad->description !!}
                            <button class="my-4 rounded block text-black hover:text-white bg-gray-300 hover:bg-gray-500 w-1/1"><a class=" px-4 py-2 block uppercase" href="{{ $ad->click_url }}" target="_blank">Play Now</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $ads->links() }}
        </div>
    </div>

</body>
</html>
