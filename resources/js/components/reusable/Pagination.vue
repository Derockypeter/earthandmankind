<template>
    <div>
        <ul class="pagination center">
            <li v-bind:class="[{ 'disabled': meta_data.prev_page_url === null}]" class="btn-small grey">
                <a href=""  @click="next(meta_data.current_page-1)"><i class="material-icons">chevron_left</i></a>
            </li>
            <!-- <li v-for="page in meta_data.last_page_url" 
                :key="page" 
                :class="{ 'active': meta_data.current_page === page }">
                <a href="#" 
                    @click.prevent="next(page)" 
                >
                    {{ page }}
                </a>
            </li> -->
            <li :class="[{ 'disabled': meta_data.next_page_url === null }]" class="btn-small grey">
                <a  href="#"  @click="next(meta_data.current_page+1)"><i class="material-icons">chevron_right</i></a>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: ['meta_data'],
    methods: {
        next(page) {
            this.$emit('next', page);
        }
    }
}
</script>