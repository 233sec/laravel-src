@if ($errors->any())
    <div class="alert alert-danger" style="margin: 0 0 -52px 0;">
        @foreach ($errors->all() as $error)
            {!! $error !!}&nbsp;
        @endforeach
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
    </div>
@elseif (session()->get('flash_success'))
    <div class="alert alert-success" style="margin: 0 0 -52px 0;">
        @if(is_array(json_decode(session()->get('flash_success'), true)))
            {!! implode('', session()->get('flash_success')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_success') !!}
        @endif
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
    </div>
@elseif (session()->get('flash_warning'))
    <div class="alert alert-warning" style="margin: 0 0 -52px 0;">
        @if(is_array(json_decode(session()->get('flash_warning'), true)))
            {!! implode('', session()->get('flash_warning')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_warning') !!}
        @endif
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
    </div>
@elseif (session()->get('flash_info'))
    <div class="alert alert-info" style="margin: 0 0 -52px 0;">
        @if(is_array(json_decode(session()->get('flash_info'), true)))
            {!! implode('', session()->get('flash_info')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_info') !!}
        @endif
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
    </div>
@elseif (session()->get('flash_danger'))
    <div class="alert alert-danger" style="margin: 0 0 -52px 0;">
        @if(is_array(json_decode(session()->get('flash_danger'), true)))
            {!! implode('', session()->get('flash_danger')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_danger') !!}
        @endif
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
    </div>
@elseif (session()->get('flash_message'))
    <div class="alert alert-info" style="margin: 0 0 -52px 0;">
        @if(is_array(json_decode(session()->get('flash_message'), true)))
            {!! implode('', session()->get('flash_message')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_message') !!}
        @endif
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
    </div>
@endif