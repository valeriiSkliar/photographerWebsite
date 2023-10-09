<style>
    .flex-box{
        width: 100%;
        height: 100%;
        background-color: #00A7AA;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1%;
        justify-content: space-between;
        overflow: auto;
    }
    .image-box {
        flex: 1;
        min-width: calc(25% - 2%);
        box-sizing: border-box;
    }
    .image-box img {
        max-width: 100%;
        height: auto;
        display: block;
    }
</style>
<div class="flex-box">
    @foreach($images as $image)
        <div class="image-box">
            <img src="{{ $image->file_url }}" alt="{{$image->alt_text}}">
        </div>
    @endforeach
</div>
