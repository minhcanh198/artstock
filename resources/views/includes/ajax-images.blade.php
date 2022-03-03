@php
$i = 0;
@endphp
@if($images->count() > 0)
    <section id="photos" class="baguetteBoxOne gallery ">
        @foreach($images as $image)

            @php
                $colors = explode(",", $image->colors);
                $color = $colors[0];
                if($image->extension == 'png' ) {
                    $background = 'background: url('.url('img/pixel.gif').') repeat center center #e4e4e4;';
                }  else {
                    $background = 'background-color: #'.$color.'';
                }
                if($settings->show_watermark == '1') {
                    $thumbnail = 'uploads/preview/'.$image->preview;
                } else {
                    $stockImage = App\Models\Stock::whereImagesId($image->id)->whereType('small')->select('name')->first();
                    $thumbnail = 'uploads/small/'.$stockImage->name;
                }

                $watermarkedVideoPath = 'uploads/video/water_mark_large/';
            @endphp
            @if($image->is_type == "video")
                <div class="box">
                    <a href="{{ url('video', $image->id ) }}/{{str_slug($image->title)}}">
                        <video onmouseover="this.play()" onmouseout="this.pause()" width="320" height="240"  muted loop>
                            @if($image->extension == "mp4")
                                <source src="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$image->thumbnail }}" type="video/mp4">
                            @endif
                            <!-- <source src="movie.ogg" type="video/ogg"> -->
                            Your browser does not support the video tag.
                        </video>
                    </a>
                </div>
            @else
                @if($i == 0)
                    <div class="box"><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                @endif

                @if($i==1 || $i == 2)
                    @if($i == 1)
                        <div class="box2" ><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                    @endif
                    @if($i == 2)
                        <div class="box2" ><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                    @endif
                @endif

                @if($i == 3)
                    <div class="box"><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                    <br>
                @endif
                <?php $i++; ?>
                @if($i == 4)
                    <?php $i = 0; ?>
                @endif
            @endif
        @endforeach
    </section>
@else
    <div class="row">
        <div class="col-md-12 margin-top-20 margin-bottom-20">
            <div class="btn-block text-center">
                <i class="icon icon-Picture ico-no-result"></i>
            </div>
            <h3 class="margin-top-none text-center no-result no-result-mg">
            No results have been found
            </h3>
        </div>
    </div>
@endif
