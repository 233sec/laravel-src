@extends('frontend.layouts.page')

@section('wrap')
    <div class="jumbotron text-center">
        <h1>Hello, 白帽子</h1>
        <p>某某公司致力于为中国企业提供电商解决方案, 在业务飞进的同时不可避免会出现安全问题, 我们希望汇聚群众的力量, 提升自身安全能力, 互利互惠.</p>
        <p>
            <a href="{{ URL::Route('frontend.user.vul.create') }}" class="btn btn-success btn-lg no-border">提交漏洞</a>
        </p>
    </div>
@endsection
