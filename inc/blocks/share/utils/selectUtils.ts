export const selectUtils = {
    getOptions: (array) => {
        return array.map((item) => {
            return {
                label: item.title.rendered,
                value: item.id
            }
        })
    }
}