import { createBrowserRouter } from "react-router-dom";
import App from "../App";
import ProductDetails from '../Pages/ProductDetails'
import Home from '../Pages/Home'

const router = createBrowserRouter([
    {
        path: "/",
        element: <Home></Home>,
    },
    {
        path: "/product/details",
        element: <ProductDetails></ProductDetails>,
    }
]);

export default router;