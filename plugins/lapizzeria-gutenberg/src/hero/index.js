const { registerBlockType } = wp.blocks;

//Logo para el bloque
import { ReactComponent as Logo } from "../logo.svg";

registerBlockType("lapizzeria/hero", {
  title: "La Pizzeria Hero",
  icon: { src: Logo },
  category: "lapizzeria",
  edit: (props) => {
    return <div>La Pizzeria Hero Editor</div>;
  },
  save: (props) => {
    return <div>La Pizzeria Hero Frontend</div>;
  },
});
