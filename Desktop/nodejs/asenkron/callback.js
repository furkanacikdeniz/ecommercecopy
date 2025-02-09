// console.log('1.görev')
// console.log('2.görev')
// console.log('3.görev')


/*const func1 = () =>{
    console.log('func 1 tamamlandı')
}
const func2 = () =>{
    console.log('func 2 tamamlandı')
}

func2();
func1();
*/
/*const func1 = () =>{
    console.log('func 1 tamamlandı')
    func2();
}
const func2 = () =>{
    console.log('func 2 tamamlandı')
    func3();
}
const func3 = () =>{
    console.log('func 3 tamamlandı')
    
}
func1();*/

const books = [
    {name:'Kitap 1',author:'yazar 1'},
    {name:'Kitap 2',author:'yazar 2'},
    {name:'Kitap 3',author:'yazar 3'}
]
const listbooks= () => {
    books.map(book => {
        console.log(book.name);

    })
};
const addbook= (newbook,callback) => {
    books.push(newbook)
    callback();
};
addbook({name:'Kitap 4',author:'yazar 4'},listbooks)
addbook({name:'Kitap 5',author:'yazar 4'},listbooks)
//listbooks();
console.log(books[3])