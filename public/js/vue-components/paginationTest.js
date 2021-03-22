let currentPage = 20;
let start = '';
let end = '';
const range = 5;
const lastPage = 20;

if (currentPage <= range) {
  start = 3;
  end = range + 2;
} else if (currentPage > lastPage - range) {
  start = lastPage - range - 1;
  end = lastPage - 2;
} else {
  start = currentPage - Math.floor(range / 2);
  end = currentPage + Math.floor(range / 2);
}

const rangeArr = [];

for (let i = start; i <= end; i++) {
  rangeArr.push(i);
}

console.log(rangeArr);
