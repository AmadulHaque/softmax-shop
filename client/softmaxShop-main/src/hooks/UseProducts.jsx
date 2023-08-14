import { useQuery } from "@tanstack/react-query";

import {baseUrl} from '../Helper/Config'
const UseProducts = () => {
    let params = new URLSearchParams(window.location.search);
    let slug = params.get('slug');
   
    const { data, refetch, isLoading } = useQuery({
        queryKey: ['products'],
        queryFn: async () => {
            const res = await fetch(`${baseUrl}/getBy/one/${slug}`)
            return res.json()
        }
    });

    return [data, refetch, isLoading];
};

export default UseProducts;