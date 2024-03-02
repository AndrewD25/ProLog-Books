//Test collection data
let testData = {
    "DC": [
        {
            title: "Batman #129",
            subtitle: "DC Comics, Dawn of DC",
            image: "https://s3.amazonaws.com/comicgeeks/comics/covers/large-4298766.jpg?1688842554",
            notes: "Start of Failsafe arc",
            read: "Read",
            rating: "Good"
        },
        {
            title: "Green Lantern Rebirth #1",
            subtitle: "DC Comics, Post Crisis",
            image: "../Images/exampleCover.png",
            notes: "This book good.",
            read: "Read",
            rating: "Great"
        },
        {
            title: "Green Lantern Rebirth #2",
            subtitle: "DC Comics, Post Crisis",
            image: "https://prodimage.images-bn.com/pimages/2940045386319_p0_v1_s1200x630.jpg",
            notes: "This book good 2.",
            read: "Read",
            rating: "Great"
        },
        {
            title: "Superman Secret Identity",
            subtitle: "Andrew's Favorite Book",
            image: "https://upload.wikimedia.org/wikipedia/en/4/4d/Superman-secretidentity1.jpg",
            notes: "Peak fiction",
            read: "Read",
            rating: "Favorite"
        }
    ],
    "Manga": [
        {
            title: "Blue Lock vol 1",
            subtitle: "Barnes and Noble Exclusive",
            image: "https://prodimage.images-bn.com/pimages/9798888772300_p0_v1_s1200x630.jpg",
            notes: "This book good 4.",
            read: "Read",
            rating: "Favorite"
        },
        {
            title: "Kaiju No. 8 vol 8",
            subtitle: "Funny volume",
            image: "https://prodimage.images-bn.com/pimages/9781974740628_p0_v1_s1200x630.jpg",
            notes: "",
            read: "Read",
            rating: "Great"
        },
        {
            title: "Kaguya Sama vol 1",
            subtitle: "Love is War",
            image: "https://m.media-amazon.com/images/I/61EP4kOgxyL._AC_UF1000,1000_QL80_.jpg",
            notes: "",
            read: "Read",
            rating: "Great"
        },
    ],
    "Marvel": [
        {
            title: "Amazing Fantasy #15",
            subtitle: "First Appearance Spider-Man",
            image: "https://m.media-amazon.com/images/I/51ylofh3QmL.jpg",
            notes: "This book good 3.",
            read: "Unread",
            rating: "---"
        },
        {
            title: "Amazing Spider-Man by Nick Spencer Omnibus",
            subtitle: "Testing a long name",
            image: "https://m.media-amazon.com/images/I/51Msd0CX31L.jpg",
            notes: "Good spidey writing.",
            read: "Read",
            rating: "---"
        },
    ],
}; //Store all folders from the db into this objet
//Then add the books into the folders as arrays