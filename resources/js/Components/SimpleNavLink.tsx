import {PropsWithChildren} from "react";

type SimpleNavLinkProps = {
    href: string;  // The link URL should be passed as a prop
};

export default function SimpleNavLink({ href, children }: PropsWithChildren<SimpleNavLinkProps>) {
    return (
        <a href={href} className="mr-4 hover:text-gray-300">
            {children}
        </a>
    );
}



