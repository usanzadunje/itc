export default async function redirectIfAuthenticated({ next, loggedIn, router }) {
    if(loggedIn) {
        router.replace({ name: 'welcome' });
    }else {
        next();
    }
}