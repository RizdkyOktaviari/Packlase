@section('titless', 'Packlese - Laundry-in Yuk!')
<main id="main">
  <!-- ======= Single Blog Section ======= -->
  <section class="hero-section inner-page">
    <div class="wave">

      <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
            <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
          </g>
        </g>
      </svg>

    </div>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-md-10 text-center hero-text">
              <h1 data-aos="fade-up" data-aos-delay="">Laundry-in Yuk!</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <section class="site-section mb-4">
    <div class="container">
      <div class="row">
        <div class="col-md-7 blog-content">
          <div class="mt-3 mb-3">
            <h4>Layanan Laundry</h4>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                @foreach ($laundry as $key => $photo)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></button>
                @endforeach
              </div>
              <div class="carousel-inner">
                @foreach ($laundry as $key => $photo)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                  <img src="{{ asset($photo->picturePath) }}" class="d-block w-100" width="500" height="350">
                </div>
                @endforeach
              </div>
              <button type="button" class="carousel-control-prev" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button type="button" class="carousel-control-next" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="number" name="inputName" id="rating-readonly" class="rating" data-clearable="remove" value="{{round($jenis_service->rate)}}" data-readonly/>
              <span style="margin-left:3px;">{{round($jenis_service->rate,2)}}({{$Rates}})</span>
            </div>
            {!!$laundry[0]->description!!}
          </div>
          <div class="pt-5">
            <h6 class="mb-5">Komentar</h6>
            <div class="card border-0">
              <div class="card-body">
                <ul class="comment-list">
                  @if(count($laundryPaginate) != 0)
                  @foreach($laundryPaginate as $comment)
                  <li class="comment border-bottom">
                    <div class="vcard bio">
                      <img src="{{asset('storage/'.$comment->user->profile_photo_path)}}" alt="{{$comment->user->name}}">
                    </div>
                    <div class="comment-body">
                      <h6>{{$comment->user->name}}</h6>
                      <div class="meta">{{$comment->created_at->diffForHumans()}}</div>
                      <p>{{$comment->komentar}}</p>
                    </div>
                    <ul class="children">
                      @foreach($comment->child()->orderBy('created_at', 'desc')->get() as $nestedComment)
                      <li class="comment">
                        <div class="vcard bio">
                          <img src="{{asset('storage/'.$nestedComment->user->profile_photo_path)}}" alt="{{$nestedComment->user->name}}">
                        </div>
                        <div class="comment-body">
                          <h6>{{$nestedComment->user->name}}</h6>
                          <div class="meta">{{$nestedComment->created_at->diffForHumans()}}</div>
                          <p>{{$nestedComment->komentar}}</p>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </li>
                  <hr>
                  @endforeach
                  @else
                  <li class="comment">Tidak Ada Komentar</li>
                  @endif
                </ul>
              </div>
              <div class="card-body">
                <div class="float-end">
                  {{ $laundryPaginate->links() }}
                </div>
              </div>
            </div>
            <div class="comment-form-wrap pt-5">
              <h6 class="mb-5">Beri Komentar</h6>
              <form wire:submit.prevent="saveComment">
                @csrf
                <div class="form-group mt-3">
                  <label for="message">Komentar</label>
                  <textarea name="comment" id="message" cols="30" rows="10" class="form-control" wire:model="comment"></textarea>
                </div>
                <div class="form-group mt-3">
                  <button type="submit" name="button" class="btn btn-primary">Kirim</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-5 sidebar">
          <div class="mt-3 mb-3">
            <h4>Pesan Sekarang</h4>
            @livewire('jenis-laundry')
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- Modal -->
<div id="updaterating_laundry" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Beri Rating</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Tempat</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#rate-laundry").click(function(){
    $('#updaterating_laundry').modal('show');
  });
});
</script>
