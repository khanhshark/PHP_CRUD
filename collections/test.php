<script type="module">
const jsonString = '{"name": "John", "age": 30, "city": "New York"}';

const jsonObject = JSON.parse(jsonString, (key, value) => {
    if (typeof value === 'string') {
        return value.toUpperCase(); // Chuyển đổi tất cả giá trị chuỗi thành chữ in hoa
    }
    return value;
});

console.log(jsonObject); // Output: { name: 'JOHN', age: 30, city: 'NEW YORK' }

</script>
