<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div id="app">
    <!-- コンポーネントの呼び出し -->
    <v-test></v-test>
</div>

<!-- コンポーネントのテンプレートを外部化 -->
<script id="component-template" type="text/x-template">
    <div v-text="text"></div>
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/vue@3.0.2/dist/vue.global.prod.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script>

    const testComponent = {
        data() {
            return {
                text: 'テストテキストです'
            }
        },
        template: '#component-template'
    };

    Vue.createApp({

    })
    .component('v-test', testComponent)
    .mount('#app');

</script>
</body>
</html>
