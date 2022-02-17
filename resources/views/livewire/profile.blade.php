<div class="main-content">
  <!-- Top navbar -->
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{route('welcome')}}">Back To Home</a>
      <!-- Form -->
      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="{{route('profile')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{asset('storage/'.Auth::user()->profile_photo_path)}}">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Header -->
  <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-lg-7 col-md-10">
          <h1 class="display-2 text-white">Hello {{Auth::user()->name}}</h1>
          <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <a href="#">

                  <img src="{{asset('storage/'.Auth::user()->profile_photo_path)}}" class="rounded-circle">
                </a>
              </div>
            </div>
          </div>
          <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="d-flex justify-content-between">
              <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
              <a href="#" class="btn btn-sm btn-default float-right">Message</a>
            </div>
          </div>
          <div class="card-body pt-0 pt-md-4">
            <div class="row">
              <div class="col">
                <div class="d-flex justify-content-center">
                  <div class="upload-btn-wrapper">
                    <button class="btn1" wire:click="selectItem({{ Auth::user()->id }}, 'update_image')">Edit Profile Picture</button>
                  </div>
                </div>

                <div class="card-profile-stats d-flex justify-content-center mt-md-1">
                  <div>
                    <span class="heading">22</span>
                    <span class="description">Friends</span>
                  </div>
                  <div>
                    <span class="heading">10</span>
                    <span class="description">Photos</span>
                  </div>
                  <div>
                    <span class="heading">89</span>
                    <span class="description">Comments</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center">
              <h3>
                {{Auth::user()->name}}
              </h3>
              <div class="h3 font-weight-500">
                <i class="ni location_pin mr-2"></i>{{Auth::user()->email}}
              </div>
              <div class="h3 mt-1">
                <i class="ni business_briefcase-24 mr-2"></i>{{Auth::user()->address}}
              </div>
              <div>
                <i class="ni education_hat mr-2"></i>{{Auth::user()->phoneNumber}}
              </div>
              <hr class="my-4">
              <p>Cara Edit Profile Anda Adalah Dengan Menekan Label Edit Pada Data Yang Ingin Anda Ubah</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">My account</h3>
              </div>
              <div class="col-4 text-right">
                <a href="#" wire:click="setting('Setting')" class="btn btn-sm btn-primary">Change Password</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form>
              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-username"><a class="form-control-label" wire:click="selectItem({{ Auth::user()->id }}, 'Username')">Edit</a>
                        Username</label>
                      <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="{{Auth::user()->name}}" disabled>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-email"><a class="form-control-label" wire:click="selectItem({{ Auth::user()->id }}, 'Email')">Edit</a>
                         Email address</label>
                       <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="email" value="{{Auth::user()->email}}" disabled>

                                            </div>
                                          </div>
                                        </div>

              </div>
              <hr class="my-4">
              <!-- Address -->
              <h6 class="heading-small text-muted mb-4">Contact information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address"><a class="form-control-label" wire:click="selectItem({{ Auth::user()->id }}, 'update_address')">Edit</a>
                         Address</label>
                      <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="{{Auth::user()->address}}" type="text" disabled>
                    </div>
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address"><a class="form-control-label" wire:click="selectItem({{ Auth::user()->id }}, 'update_phoneNumber')">Edit</a>
                         Phone Number</label>
                      <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="{{Auth::user()->phoneNumber}}" type="text" disabled>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change Username</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @livewire('jenis-profile')
              </div>
          </div>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalForm_email" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="emailModalLabel">Change Email</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @livewire('jenis-profile-email')
              </div>
          </div>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="update_address" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="addressModalLabel">Change Address</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @livewire('jenis-profile-address')
              </div>
          </div>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="update_phoneNumber" tabindex="-1" aria-labelledby="phoneNumberModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="phoneNumberModalLabel">Change Phone Number</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @livewire('jenis-profile-phone')
              </div>
          </div>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="update_image" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="imageModalLabel">Change Photo Profile</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @livewire('jenis-profile-image')
              </div>
          </div>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="update_setting" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="imageModalLabel">Change Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @livewire('setting-user')
              </div>
          </div>
      </div>
  </div>
