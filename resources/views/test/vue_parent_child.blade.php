<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

    <div id="app" class="p-5">
        <!-- コンポーネントの呼び出し -->
        <v-email-input v-model="myEmail"></v-email-input>
        <div class="py-3">
            <strong>現在の値: </strong><span v-text="myEmail"></span>
        </div>
        <button type="button" class="btn btn-info" @click="myEmail = 'hello@example.com'">クリックして E-Mailを変更</button>
    </div>

    <!-- コンポーネントのテンプレートを外部化 -->
    <script id="email-input-template" type="text/x-template">
        <div class="bg-light p-3 border">
            （ここはコンポーネント内部）
            <br>
            E-Mail: <input type="text" v-model="email" @input="onInput">
        </div>
    </script>

    <script src="https://unpkg.com/vue@3.0.2/dist/vue.global.prod.js"></script>
    <script>

        const emailInputComponent = {
            props: {
                modelValue: {   // modelValue は、v-model とペアになります（※ Vue 2 では `value` でした）
                    type: String,
                    default: ''
                }
            },
            data() {
                return {
                    email: ''
                }
            },
            methods: {
                onInput() {

                    this.$emit('update:modelValue', this.email); // 親側へ変更を通知（※ Vue 2では、`input` でした）

                }
            },
            watch: {
                modelValue: { // v-model に変更があったら実行されます
                    immediate: true, // コンポーネントが起動してすぐの瞬間でも実行する
                    handler(value) {

                        // 入ってきた v-model の値は変数へ入れ替えます
                        // なぜなら、コンポーネント内で直接データの変更をすべきでないとされているからです。
                        // 詳しくは、以下のURLをご参照ください。
                        // https://blog.capilano-fw.com/?p=7622
                        this.email = value;

                    }
                }
            },
            template: '#email-input-template'
        };

        Vue.createApp({
            data() {
                return {
                    myEmail: 'test@example.com'
                }
            }
        })
        .component('v-email-input', emailInputComponent)
        .mount('#app');

    </script>
</body>
</html>
