<div class="col-md-3">
    <ul class="list-group">
        <a href="{{route('home')}}"><li class="list-group-item {{request()->routeIs('home') ? 'active' : '' }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</li></a>
        <a href="{{route('activity.index')}}"><li class="list-group-item {{request()->routeIs('activity*') ? 'active' : '' }}"><i class="fa fa-history" aria-hidden="true"></i> Aktivitas</li></a>
        <a href="{{route('school.index')}}"><li class="list-group-item {{request()->routeIs('school*') ? 'active' : '' }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Profil Sekolah</li></a>
        <a href="{{route('teacher.index')}}"><li class="list-group-item {{request()->routeIs('teacher*') ? 'active' : '' }}"><i class="fa fa-user" aria-hidden="true"></i> Admin & Guru</li></a>
        <li class="list-group-item {{request()->routeIs('partner*') ? 'active' : '' }}"><i class="fa fa-group" aria-hidden="true"></i> Partner & Kejuruan</li>
        <li class="list-group-item {{request()->routeIs('news*') ? 'active' : '' }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Berita & Pengumuman</li>
        <li class="list-group-item {{request()->routeIs('download*') ? 'active' : '' }}"><i class="fa fa-download" aria-hidden="true"></i> Logo & Unduh</li>
        <li class="list-group-item {{request()->routeIs('featured*') ? 'active' : '' }}"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Featured Menu & Link</li>
        <li class="list-group-item {{request()->routeIs('banner*') ? 'active' : '' }}"><i class="fa fa-picture-o" aria-hidden="true"></i> Banner & Galeri</li>
        <li class="list-group-item {{request()->routeIs('sosmed*') ? 'active' : '' }}"><i class="fa fa-facebook-square" aria-hidden="true"></i> Sosial Media</li>
    </ul>
</div>
