@extends('layouts.app')
@section('content')
    <!-- component -->
<div class="max-w-screen-xl mx-auto">

    <main class>

      <div class="mb-4 md:mb-0 w-full max-w-screen-md mx-auto relative" style="height: 24em;">
        <div class="absolute left-0 bottom-0 w-full h-full z-10"
          style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
        <img src="{{ asset('storage/'.$detail->cover) }}" class="absolute left-0 top-0 w-full h-full z-0 object-cover" />
        <div class="p-4 absolute bottom-0 left-0 z-20">
          <h1 class="text-4xl font-semibold text-gray-100 leading-tight">
            {{ $detail->judul }}
          </h1>
          <div class="flex mt-3">
            <div>
              <p class="font-semibold text-gray-400 text-xs"> {{ date_format($detail->created_at,"Y/m/d H:i:s") }} </p>
            </div>
          </div>
        </div>
      </div>

      <div class="px-4 lg:px-0 mt-12 text-gray-700 max-w-screen-md mx-auto text-lg leading-relaxed">
        {{ strip_tags($detail->isi_post) }}
      </div>
    </main>
    <!-- main ends here -->
  </div>
@endsection