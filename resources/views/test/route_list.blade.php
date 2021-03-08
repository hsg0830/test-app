@php

$grouped_routes = \Illuminate\Support\Facades\Route::getRoutes()->getRoutesByMethod();

@endphp
<div id="dev-route" style="display:none;position:absolute;width:100%;top:0;left:0;color:#333;">
  <div style="background-color:#ccc;margin:15px;padding:15px;">
    <input id="dev-route-filter" type="text" style="padding:3px;margin-bottom:15px;" placeholder="ルート名で絞り込み">
    <br>
    @foreach ($grouped_routes as $method => $routes)
      @foreach ($routes as $route)
        @if ($method === 'GET')
          @php
            
            $index = $loop->index;
            $content = preg_replace_callback(
                '|\{[^\}]*\}|',
                function ($matches) use ($index) {
                    return '<input ' .
                        'type="text" ' .
                        'style="padding:2px;width:100px;font-size:14px;margin:0 5px;" ' .
                        'class="dev-route-input dev-route-input-' .
                        $index .
                        '" ' .
                        'placeholder="' .
                        $matches[0] .
                        '"' .
                        'data-pattern="' .
                        $matches[0] .
                        '"' .
                        'data-index="' .
                        $index .
                        '"
                                            onfocus="this.select()">';
                },
                $route->uri,
            );
            
          @endphp
          <div class="dev-route-item" style="padding-bottom:7px;">
            {!! $content !!}
            <a id="dev-route-link-{{ $loop->index }}" href="{{ $route->uri }}" style="padding-left:10px;"
              data-uri="{{ $route->uri }}" target="_blank">開く</a>
          </div>
        @endif
      @endforeach
    @endforeach
  </div>
</div>

<script>
  window.onload = () => {

    document.querySelector('#dev-route-filter')
      .addEventListener('input', e => {

        const keyword = e.target.value;

        document.querySelectorAll('.dev-route-item').forEach(link => {

          const linkText = link.innerText;

          if (keyword === '' || linkText.includes(keyword)) {

            link.style.display = 'block';

          } else {

            link.style.display = 'none';

          }

        });

      });

    document.querySelectorAll('.dev-route-input').forEach(input => {

      input.addEventListener('input', e => {

        const target = e.target;
        const index = target.getAttribute('data-index');
        const link = document.querySelector('#dev-route-link-' + index);
        let url = link.getAttribute('data-uri');
        document.querySelectorAll('.dev-route-input-' + index)
          .forEach(input => {

            const pattern = input.getAttribute('data-pattern');
            console.log(pattern)
            url = url.replace(pattern, input.value);

          })
        link.setAttribute('href', url);

      });

    });

    document.onkeypress = e => {

      const tagName = e.target.tagName;
      const code = e.code;

      if (tagName === 'BODY' && code === 'Space') {

        const container = document.querySelector('#dev-route');

        if (container.style.display === 'none') {

          container.style.display = 'block';

          setTimeout(() => {

            const filterInput = document.querySelector('#dev-route-filter').focus();

          }, 500);

        } else {

          container.style.display = 'none';

        }

      }

    }

  };

</script>
