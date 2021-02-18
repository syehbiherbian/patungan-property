@extends('layouts.app')
@section('content')
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
    @foreach ($blog as $item)
    @php
    function limitDesc($kata, $length)
    {
        if (strlen($kata) <= $length) {
            return $kata;
        } else {
            $y = substr($kata, 0, $length) . '...';
            return $y;
        }
    } 
    @endphp
    <div class="flex flex-wrap -m-4">
        <div class="p-4 md:w-1/3">
          <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('storage/'.$item->cover) }}" alt="blog">
            <div class="p-6">
              <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $item->judul }}</h1>
              <p class="leading-relaxed mb-3">{{ strip_tags(limitDesc($item->isi_post, 50)) }}</p>
              <div class="flex items-center flex-wrap ">
                <a href="{{ ('blog/').$item->id. '/'. str_slug($item->judul, '-') }}" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                  <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
      
    </div>
  </section>
@endsection
