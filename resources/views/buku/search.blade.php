<form action="{{route('buku.search')}}" method="get">
    @csrf
    <input type="text" name="kata" class="form-control" placeholder="Cari..." style="width: 30%;
    display: inline; margin-top:10px; margin-bottom:10px;float:left;">
</form>
