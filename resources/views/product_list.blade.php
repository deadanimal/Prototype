@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Product
                </h1>

            </div>              

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of Product</h5>
                        </div>
                      

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Web</th>
                                        <th>Staging</th>
                                        <th>App Repo</th>
                                        <th>Web Repo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="/products/{{$product->id}}">{{ $product->name }}</a></td>
                                        {{-- <td>{{ $product->status }}</td> --}}
                                        <td>
                                            @if($product->web_link)
                                                <a href="{{$product->web_link}}">Link</a>
                                            @else
                                                -
                                            @endif                                            
                                        </td>
                                        <td>
                                            @if($product->prototype_link)
                                                <a href="{{$product->prototype_link}}">Link</a>
                                            @else
                                                -
                                            @endif                                             
                                        </td>
                                        <td>
                                            @if($product->app_repo)
                                                <a href="{{$product->app_repo}}">Github</a>
                                            @else
                                                -
                                            @endif                                             
                                        </td>   
                                        <td>
                                            @if($product->web_repo)
                                                <a href="{{$product->web_repo}}">Github</a>
                                            @else
                                                -
                                            @endif                                             
                                        </td>                                                                              
                                    </tr>
                                    @endforeach                                    
                                  



                                </tbody>
                            </table>                            


                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Create Product</h5>
                        </div>
                        <div class="card-body">
                            <form action="/products" method="POST" enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="5" name="description" placeholder="Textarea"></textarea>
                                </div>                                

                                <div class="mb-3">
                                    <label class="form-label">Web link</label>
                                    <input type="text" class="form-control" name="web_link">
                                </div>   
                                
                                <div class="mb-3">
                                    <label class="form-label">Prototype link</label>
                                    <input type="text" class="form-control" name="prototype_link">
                                </div>    
                                
                                <div class="mb-3">
                                    <label class="form-label">Web Repo</label>
                                    <input type="text" class="form-control" name="web_repo">
                                </div>   
                                
                                <div class="mb-3">
                                    <label class="form-label">App Repo</label>
                                    <input type="text" class="form-control" name="app_repo">
                                </div>                                  

                                <button type="submit" class="btn btn-primary">Create Product</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Horizontal form</h5>
                            <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" placeholder="Email" autocomplete="off"
                                            style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" placeholder="Password"
                                            autocomplete="off"
                                            style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Textarea</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
                                    </div>
                                </div>
                                <fieldset class="mb-3">
                                    <div class="row">
                                        <label class="col-form-label col-sm-2 text-sm-end pt-sm-0">Radios</label>
                                        <div class="col-sm-10">
                                            <label class="form-check">
                                                <input name="radio-3" type="radio" class="form-check-input"
                                                    checked="">
                                                <span class="form-check-label">Default radio</span>
                                            </label>
                                            <label class="form-check">
                                                <input name="radio-3" type="radio" class="form-check-input">
                                                <span class="form-check-label">Second default radio</span>
                                            </label>
                                            <label class="form-check">
                                                <input name="radio-3" type="radio" class="form-check-input"
                                                    disabled="">
                                                <span class="form-check-label">Disabled radio</span>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end pt-sm-0">Checkbox</label>
                                    <div class="col-sm-10">
                                        <label class="form-check m-0">
                                            <input type="checkbox" class="form-check-input">
                                            <span class="form-check-label">Check me out</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10 ms-sm-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}

            </div>


        </div>
    </main>
@endsection
