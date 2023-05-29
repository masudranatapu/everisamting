<!doctype html>
<title>Coming Soon</title>
<style>
    body {
        text-align: center;
        padding: 150px;
    }

    h1 {
        font-size: 50px;
    }

    body {
        font: 20px Helvetica, sans-serif;
        color: #333;
    }

    article {
        display: block;
        text-align: left;
        width: 850px;
        margin: 0 auto;
    }

    a {
        color: #dc8100;
        text-decoration: none;
    }

    a:hover {
        color: #333;
        text-decoration: none;
    }
</style>

<article>
    <h1>{{ $cms->coming_soon_title ?? 'Our website is not ready yet' }}!</h1>
    <div>
        <p>{{ $cms->coming_soon_subtitle ?? 'We are working on it. We will be back coming soon' }}</p>
        <p>&mdash; {{ config('app.name') }}</p>
    </div>
</article>
