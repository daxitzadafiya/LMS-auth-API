<div>
    {{-- we can set all thing here which are need for the SEO --}}
    <title>{{ $title }}</title>

    @foreach ($metaTag as $tag)
        <meta name="{{ $tag['name'] }}" content="{{ $tag['content'] }}" />
    @endforeach
</div>
