<!doctype html>
<title>Maintenance Mode</title>
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
    <h1>{{ $cms->maintenance_title ?? 'Under Construction' }}!</h1>
    <div>
        <p>{{ $cms->maintenance_subtitle ?? 'We are working hard to make our website ready for you. We will be back soon.' }}
        </p>
        <p>&mdash; {{ config('app.name') }}</p>
    </div>
</article>
