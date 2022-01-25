export default async function redirectIfAuthenticated({ next, loggedIn, router }) {
    if(!loggedIn) {
        router.replace({ name: 'login' });
    }else {
        next();
    }
}